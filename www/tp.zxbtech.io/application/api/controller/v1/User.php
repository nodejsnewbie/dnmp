<?php
/**
 * Created by 林原.
 * User: 林原
 */

namespace app\api\controller\v1;

use app\api\model\Business as BusinessModel;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\IsValidUserToken;
use app\api\validate\MerchantType;
use app\api\validate\PagingParameter;
use app\lib\exception\ParameterException;
use app\lib\exception\UserException;
use app\lib\exception\BusinessException;
use think\Controller;
use think\Exception;

class User extends Controller
{
    protected $beforeActionList = [
        'checkSuperScope' => ['only' => 'createOne,deleteOne'],
    ];

    /**
     * 根据类目ID获取该类目下所有商家(分页）
     * @url /user?id=:category_id&page=:page&size=:page_size
     * @param int $id 商家id
     * @param int $page 分页页数（可选)
     * @param int $size 每页数目(可选)
     * @return array of User
     * @throws ParameterException
     */
    public function getByCategory($id = -1, $page = 1, $size = 30)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $pagingUsers = UserModel::getUsersByCategoryID(
            $id, true, $page, $size);
        if ($pagingUsers->isEmpty()) {
            // 对于分页最好不要抛出MissException，客户端并不好处理
            return [
                'current_page' => $pagingUsers->currentPage(),
                'data' => [],
            ];
        }
        //数据集对象和普通的二维数组在使用上的一个最大的区别就是数据是否为空的判断，
        //二维数组的数据集判断数据为空直接使用empty
        //collection的判空使用 $collection->isEmpty()

        // 控制器很重的一个作用是修剪返回到客户端的结果

        //      m $t = collection($Users);
        //      m $cutUsers = collection($Users)
        //            ->visible(['id', 'name', 'img'])
        //            ->toArray();

//        $collection = collection($pagingUsers->items());
        $data = $pagingUsers
            ->hidden(['summary'])
            ->toArray();
        // 如果是简洁分页模式，直接序列化$pagingUsers这个Paginator对象会报错
        //        $pagingUsers->data = $data;
        return [
            'current_page' => $pagingUsers->currentPage(),
            'data' => $data,
        ];
    }

    /**
     * 获取指定数量的附近近商家
     * @url /user/recent?count=:count
     * @param int $count
     * @return mixed
     * @throws ParameterException
     */
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $users = UserModel::getMostRecent($count);
        if ($users->isEmpty()) {
            throw new UserException();

        }
        $users = $users->hidden(
            [
                'summary',
            ])
            ->toArray();
        return $users;
    }

    /**
     * 根据服务类型id及服务商类型获取服务商列表
     * @url /user/by_service/:id
     * @param int $id 商家id号
     * @return User
     * @throws UserException
     */
    public function getByService($id,$type)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new MerchantType())->goCheck();
        $businesses = BusinessModel::getByService($id, $type);
        if (!$businesses) {
            throw new BusinessException();
        }
        $merchants=[];
        foreach ($businesses as $business) {
            $merchant= $business->servicetable;
            array_push ($merchants,$merchant);
        }
        return $merchants;
    }

    /**
     * 获取商家详情
     * 如果商家详情信息很多，需要考虑分多个接口分布加载
     * @url /user/:id
     * @param int $id 商家id号
     * @return User
     * @throws UserException
     */
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $user = UserModel::getUserDetail($id);
        if (!$user) {
            throw new UserException();
        }
        return $user;
    }
    /**
     * 根据token获取用户信息
     * @url /user/info
     * @param string $token 用户token
     * @return User
     * @throws UserException
     */
    public function getUserInfo()
    {
         $identity= TokenService::getUserIdentity();
        return $identity;
    }

    public function createOne()
    {
        $user = new UserModel();
        $user->save(
            [
                'id' => 1,
            ]);
    }

    public function deleteOne($id)
    {
        UserModel::destroy($id);
        //        UserModel::destroy(1,true);
    }

}
