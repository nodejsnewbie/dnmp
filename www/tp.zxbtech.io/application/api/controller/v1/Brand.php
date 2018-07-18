<?php
/**
 * Created by 林原
 * User: 林原
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Brand as BrandModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;
use app\lib\exception\BrandException;
use app\api\validate\PagingParameter;
use app\lib\exception\ParameterException;
/**
 * Brand资源
 */
class Brand extends BaseController
{
//    protected $beforeActionList = [
    //        'checkPrimaryScope' => ['only' => 'getBrand']
    //    ];

    /**
     * 获取Brand信息
     * @url     /brand/:id
     * @http    get
     * @param   int $id brand id
     * @return  array of brand item , code 200
     * @throws  MissException
     */
    public function getBrand($id)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $brand = BrandModel::getBrandById($id);
        if (!$brand) {
            throw new MissException([
                'msg' => '请求brand不存在',
                'errorCode' => 40000,
            ]);
        }
        return $brand;
    }
    /**
     * 获取Brand信息
     * @url     /brand/by_service/:id
     * @http    get
     * @param   int $id service id
     * @return  array of brand item , code 200
     * @throws  MissException
     */
    public function getBrandService($id = -1, $page = 1, $size = 30)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $brands = BrandModel::getBrandsByServiceID($id, true, $page, $size);
        if ($brands->isEmpty()) {
            // 对于分页最好不要抛出MissException，客户端并不好处理
            return [
                'current_page' => $brands->currentPage(),
                'data' => [],
            ];
        }
        $data = $brands
            ->hidden(['service_id'])
            ->toArray();
        return [
            'current_page' => $brands->currentPage(),
            'data' => $data,
        ];

    }


     /**
     * 获取某分类下全部品牌(不分页）
     * @url /brand/all?id=:service_id
     * @param int $id 分类id号
     * @return \think\Paginator
     * @throws BrandException
     */
    public function getAllInService($id = -1)
    {
        (new IDMustBePositiveInt())->goCheck();
        $brands = BrandModel::getBrandsByServiceID(
            $id, false);
        if ($brands->isEmpty())
        {
            throw new BrandException();
        }
        $data = $brands
            ->hidden(['summary'])
            ->toArray();
        return $data;
    }
}
