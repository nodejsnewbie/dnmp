<?php
/**
 */

namespace app\api\service;

use app\api\model\Service;
use app\api\model\Image;
use app\api\model\Serviceorder as OrderModel;
use app\api\model\UserAddress;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Exception;

/**
 * 订单类
 * 订单做了以下简化：
 * 创建订单时会检测库存量，但并不会预扣除库存量，因为这需要队列支持
 * 未支付的订单再次支付时可能会出现库存不足的情况
 * 所以，项目采用3次检测
 * 1. 创建订单时检测库存
 * 2. 支付前检测库存
 * 3. 支付成功后检测库存
 */
class ServiceOrder
{
    protected $service;
    protected $uid;

    public function __construct()
    {
    }

    /**
     * @param int $uid 用户id
     * @param array $service 服务
     * @return array 订单商品状态
     * @throws Exception
     */
    public function place($uid, $service)
    {
        $this->uid = $uid;
        $this->service = $service['service'];
        $orderSnap = $this->snapOrder();
        $status = self::createOrderByTrans($orderSnap);
        $status['pass'] = true;
        return $status;
    }

    public function delivery($orderID, $jumpPage = '')
    {
        $order = OrderModel::where('id', '=', $orderID)
            ->find();
        if (!$order) {
            throw new OrderException();
        }
        if ($order->status != OrderStatusEnum::PAID) {
            throw new OrderException([
                'msg' => '还没付款呢，想干嘛？或者你已经更新过订单了，不要再刷了',
                'errorCode' => 80002,
                'code' => 403,
            ]);
        }
        $order->status = OrderStatusEnum::DELIVERED;
        $order->save();
//            ->update(['status' => OrderStatusEnum::DELIVERED]);
        $message = new DeliveryMessage();
        return $message->sendDeliveryMessage($order, $jumpPage);
    }

    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray' => [],
        ];
        foreach ($this->oProducts as $oProduct) {
            $pStatus =
            $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products);
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    private function getProductStatus($oPID, $oCount, $products)
    {
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => '',
            'totalPrice' => 0,
        ];

        for ($i = 0; $i < count($products); $i++) {
            if ($oPID == $products[$i]['id']) {
                $pIndex = $i;
            }
        }

        if ($pIndex == -1) {
            // 客户端传递的productid有可能根本不存在
            throw new OrderException(
                [
                    'msg' => 'id为' . $oPID . '的商品不存在，订单创建失败',
                ]);
        } else {
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;

            if ($product['stock'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    // 根据订单查找真实商品
    private function getProductsByOrder($service)
    {
        $oPIDs = [];
        foreach ($service as $item) {
            array_push($oPIDs, $item['product_id']);
        }
        // 为了避免循环查询数据库
        $products = Product::all($oPIDs)
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();
        return $products;
    }

    private function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id', '=', $this->uid)
            ->find();
        if (!$userAddress) {
            throw new UserException(
                [
                    'msg' => '用户收货地址不存在，下单失败',
                    'errorCode' => 60001,
                ]);
        }
        return $userAddress->toArray();
    }

    private function createOrderByTrans($snap)
    {
        try {
            $orderNo = $this->makeOrderNo();
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->service_id = $snap['service_id'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapServiceName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snapServiceName = $snap['snapServiceName'];
            $order->snapServiceType = $snap['snapServiceType'];
            $order->snapBrandName = $snap['snapBrandName'];
            $order->snapWarranty = $snap['snapWarranty'];
            $order->snapDelegateType = $snap['snapDelegateType'];
            $order->snapArriveTime = $snap['snapArriveTime'];
            $order->snapOrderTime = $snap['snapOrderTime'];
            $order->status = $snap['status'];
            $order->save();
            $orderID = $order->id;
            $create_time = $order->create_time;
            // $this->service['order_id'] = $orderID;
            // $orderService = new ServiceModel();
            // $orderService->save($this->service);
            $images = $snap['imageFiles'];
            $list = [];

            $length = count($images);
            for ($i = 0; $i < $length; $i++) {
                $image = new Image();
                $image->url = json_decode(($images[$i]))->filename;
                $image->save();
                $image->orderImages()
                      ->save(['order_id' => $orderID,'order' => $i]);
            }

            return [
                'order_no' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time,
            ];
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // 生成订单快照
    private function snapOrder()
    {
        // status可以单独定义一个类
        $snap = [
            'service_id' => $this->service['service_id'],
            'status' => $this->service['status'],
            'snapAddress' => json_encode($this->getUserAddress()),
            'snapServiceName' => $this->service['service_name'],
            'snapServiceType' => $this->service['service_type'],
            'snapBrandName' => $this->service['brand_name'],
            'snapWarranty' => $this->service['warranty'],
            'snapImg' => $this->service['main_img_url'],
            'snapDelegateType' => $this->service['delegate_type'],
            'snapArriveTime' => $this->service['arrive_time'],
            'snapOrderTime' => $this->service['order_time'],
            'imageFiles' => $this->service['image_files'],
        ];
        return $snap;
    }

    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
        $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
            'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
            '%02d', rand(0, 99));
        return $orderSn;
    }
}
