<?php
/**
 * Created by 林原.
 * User: 林原
 */

namespace app\api\controller\v1;

use app\api\model\Merchant as MerchantModel;
use app\api\model\Service as ServiceModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\lib\exception\MerchantException;
use app\lib\exception\ParameterException;
use think\Controller;
use think\Exception;

class Merchant extends Controller
{
    protected $beforeActionList = [
        'checkSuperScope' => ['only' => 'createOne,deleteOne'],
    ];

    /**
     * 根据类目ID获取该类目下所有商家(分页）
     * @url /merchant?id=:category_id&page=:page&size=:page_size
     * @param int $id 商家id
     * @param int $page 分页页数（可选)
     * @param int $size 每页数目(可选)
     * @return array of Merchant
     * @throws ParameterException
     */
    public function getByCategory($id = -1, $page = 1, $size = 30)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $pagingMerchants = MerchantModel::getMerchantsByCategoryID(
            $id, true, $page, $size);
        if ($pagingMerchants->isEmpty()) {
            // 对于分页最好不要抛出MissException，客户端并不好处理
            return [
                'current_page' => $pagingMerchants->currentPage(),
                'data' => [],
            ];
        }
        //数据集对象和普通的二维数组在使用上的一个最大的区别就是数据是否为空的判断，
        //二维数组的数据集判断数据为空直接使用empty
        //collection的判空使用 $collection->isEmpty()

        // 控制器很重的一个作用是修剪返回到客户端的结果

        //      m $t = collection($Merchants);
        //      m $cutMerchants = collection($Merchants)
        //            ->visible(['id', 'name', 'img'])
        //            ->toArray();

//        $collection = collection($pagingMerchants->items());
        $data = $pagingMerchants
            ->hidden(['summary'])
            ->toArray();
        // 如果是简洁分页模式，直接序列化$pagingMerchants这个Paginator对象会报错
        //        $pagingMerchants->data = $data;
        return [
            'current_page' => $pagingMerchants->currentPage(),
            'data' => $data,
        ];
    }

    /**
     * 获取指定数量的附近近商家
     * @url /merchant/recent?count=:count
     * @param int $count
     * @return mixed
     * @throws ParameterException
     */
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $merchants = MerchantModel::getMostRecent($count);
        if ($merchants->isEmpty()) {
            throw new MerchantException();

        }
        $merchants = $merchants->hidden(
            [
                'summary',
            ])
            ->toArray();
        return $merchants;
    }

     /**
     * 根据服务类型id获取商家列表
     * @url /merchant/by_service/:id
     * @param int $id 商家id号
     * @return Merchant
     * @throws MerchantException
     */
    public function getServices($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $merchant= MerchantModel::get($id);
        $services=$merchant->services;
        $result=[];
        $serviceModel=new ServiceModel();
        foreach($services as $service) {
           $bussiness= $serviceModel->get($service->id);
           array_push($result,$bussiness);
        }
        return $result;
    }

    /**
     * 获取商家详情
     * 如果商家详情信息很多，需要考虑分多个接口分布加载
     * @url /merchant/:id
     * @param int $id 商家id号
     * @return Merchant
     * @throws MerchantException
     */
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $merchant = MerchantModel::getMerchantDetail($id);
        if (!$merchant) {
            throw new MerchantException();
        }
        return $merchant;
    }

    public function createOne()
    {
        $merchant = new MerchantModel();
        $merchant->save(
            [
                'id' => 1,
            ]);
    }

    public function deleteOne($id)
    {
        MerchantModel::destroy($id);
        //        MerchantModel::destroy(1,true);
    }

}
