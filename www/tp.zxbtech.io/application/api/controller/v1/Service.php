<?php
/**
 * Created by 林原.
 * User: 林原
 */

namespace app\api\controller\v1;

use app\api\model\Service as ServiceModel;
use app\api\model\User;
use app\api\model\Merchant;
use app\api\model\Business as BusinessModel;
use app\api\model\ServiceType as ServiceTypeModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\MerchantType;
use app\lib\exception\ParameterException;
use app\lib\exception\ServiceException;
use app\lib\exception\ServiceTypeException;
use app\lib\exception\ThemeException;
use think\Controller;
use think\Exception;

class Service extends Controller
{
    protected $beforeActionList = [
        'checkSuperScope' => ['only' => 'createOne,deleteOne'],
    ];

    /**
     * 根据类目ID获取该类目下所有服务(分页）
     * @url /service?id=:category_id&page=:page&size=:page_size
     * @param int $id 服务id
     * @param int $page 分页页数（可选)
     * @param int $size 每页数目(可选)
     * @return array of Service
     * @throws ParameterException
     */
    public function getByCategory($id = -1, $page = 1, $size = 30)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $pagingServices = ServiceModel::getServicesByCategoryID(
            $id, true, $page, $size);
        if ($pagingServices->isEmpty()) {
            // 对于分页最好不要抛出MissException，客户端并不好处理
            return [
                'current_page' => $pagingServices->currentPage(),
                'data' => [],
            ];
        }
        //数据集对象和普通的二维数组在使用上的一个最大的区别就是数据是否为空的判断，
        //二维数组的数据集判断数据为空直接使用empty
        //collection的判空使用 $collection->isEmpty()

        // 控制器很重的一个作用是修剪返回到客户端的结果

        //        $t = collection($services);
        //        $cutServices = collection($services)
        //            ->visible(['id', 'name', 'img'])
        //            ->toArray();

//        $collection = collection($pagingServices->items());
        $data = $pagingServices
            ->hidden(['summary'])
            ->toArray();
        // 如果是简洁分页模式，直接序列化$pagingServices这个Paginator对象会报错
        //        $pagingServices->data = $data;
        return [
            'current_page' => $pagingServices->currentPage(),
            'data' => $data,
        ];
    }

    /**
     * 获取某分类下全部服务(不分页）
     * @url /service/all?id=:category_id
     * @param int $id 分类id号
     * @return \think\Paginator
     * @throws ServiceException
     */
    public function getAllInCategory($id = -1)
    {
        (new IDMustBePositiveInt())->goCheck();
        $services = ServiceModel::getServicesByCategoryID(
            $id, false);
        if ($services->isEmpty()) {
            throw new ServiceException();
        }
        $data = $services
            ->hidden(['summary'])
            ->toArray();
        return $data;
    }

    /**
     * 获取指定数量的最近服务
     * @url /service/recent?count=:count
     * @param int $count
     * @return mixed
     * @throws ParameterException
     */
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $services = ServiceModel::getMostRecent($count);
        if ($services->isEmpty()) {

        }
        $services = $services->hidden(
            [
                'summary',
            ])
            ->toArray();
        return $services;
    }

    /**
     * 获取服务详情
     * 如果服务详情信息很多，需要考虑分多个接口分布加载
     * @url /service/:id
     * @param int $id 服务id号
     * @return Service
     * @throws ServiceException
     */
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $service = ServiceModel::getServiceDetail($id);
        if (!$service) {
            throw new ServiceException();
        }
        return $service;
    }
    /**
     * 根据服务名和类型（独立工程师或商户)获取服务商详情
     * @url service/by_servicename
     * @param string $name  服务名
     * @return merchant
     * @throws ServiceException
     */
    public function getMerchants($id, $type)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new MerchantType())->goCheck();
        $businesses = BusinessModel::getByService($id,$type);
        $merchants=[];
        foreach($businesses as $business) {
            array_push($merchants,$business->servicetable);
        }
        return $merchants;
    }
    /**
     * 根据服务id获取服务类型
     * @url service/by_service
     * @param string $id  服务id
     * @return serviceType
     * @throws ServiceTypeException
     */
    public function getServiceTypesByService($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $serviceTypes = ServiceTypeModel::getServiceTypesByServiceID($id,false);
        if (!$serviceTypes) {
            throw new ServiceTypeException();
        }
        $data = $serviceTypes
            ->hidden(['summary'])
            ->toArray();
        return $data;
    }

    public function createOne()
    {
        $service = new ServiceModel();
        $service->save(
            [
                'id' => 1,
            ]);
    }

    public function deleteOne($id)
    {
        ServiceModel::destroy($id);
        //        ServiceModel::destroy(1,true);
    }

}
