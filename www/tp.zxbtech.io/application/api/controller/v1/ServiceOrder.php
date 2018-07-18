<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Serviceorder as OrderModel;
use app\api\service\ServiceOrder as OrderService;
use app\api\service\Token;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\ServiceOrderPlace;
use app\lib\exception\OrderException;
use app\lib\exception\SuccessMessage;
use think\Controller;

class ServiceOrder extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder,cancleOrder'],
        'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser'],
        'checkSuperScope' => ['only' => 'delivery,getSummary'],
    ];

    /**
     * 下单
     * @url /order
     * @HTTP POST
     */
    public function placeOrder()
    {
        (new ServiceOrderPlace())->goCheck();
        $service = input('post.');
        $uid = Token::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid, $service);
        return $status;
    }

    /**
     * 取消订单
     * @url /order
     * @HTTP DELETE
     */
    public function cancleOrder($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $order = OrderModel::get($id);
        if (!$order) {
            throw new OrderException();
        }
        $order->status = 6;
        $order->save();
        return new SuccessMessage();
    }
    /**
     * 重新发布订单
     * @url /order
     * @HTTP DELETE
     */
    public function refreshOrder($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $order = OrderModel::get($id);
        if (!$order) {
            throw new OrderException();
        }
        $order->status = 0;
        $order->save();
        return new SuccessMessage();
    }

    /**
     * 获取订单详情
     * @param $id
     * @return static
     * @throws OrderException
     * @throws \app\lib\exception\ParameterException
     */
    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderDetail = OrderModel::getServiceOrderDetail($id);
        if (!$orderDetail) {
            throw new OrderException();
        }
        return $orderDetail
            ->hidden(['prepay_id']);
    }

    /**
     * 根据用户id分页获取订单列表（简要信息）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummaryByUser($page = 1, $size = 15)
    {
        (new PagingParameter())->goCheck();
        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if ($pagingOrders->isEmpty()) {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => [],
            ];
        }
//        $collection = collection($pagingOrders->items());
        //        $data = $collection->hidden(['snap_items', 'snap_address'])
        //            ->toArray();
        $data = $pagingOrders->hidden(['snap_items', 'snap_address'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data,
        ];

    }

    /**
     * 获取全部订单简要信息（分页）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummary($page = 1, $size = 20)
    {
        (new PagingParameter())->goCheck();
//        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByPage($page, $size);
        if ($pagingOrders->isEmpty()) {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => [],
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data,
        ];
    }

    public function delivery($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $order = new OrderService();
        $success = $order->delivery($id);
        if ($success) {
            return new SuccessMessage();
        }
    }
}
