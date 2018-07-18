<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Servicecategory as ServicecategoryModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\Controller;

class Servicecategory extends BaseController
{
    /**
     * 获取全部服务类目列表，但不包含类目下的服务
     * Request 演示依赖注入Request对象
     * @url /servicecategory/all
     * @return array of Categories
     * @throws MissException
     */
    public function getAllCategories()
    {
        $categories = ServicecategoryModel::all([], 'img');
        if (empty($categories)) {
            throw new MissException([
                'msg' => '还没有任何类目',
                'errorCode' => 50000,
            ]);
        }
        return $categories;
    }


    /**
     * 这里没有返回类目的关联属性比如类目图片
     * 只返回了类目基本属性和类目下的所有服务
     * 返回什么，返回多少应该根据团队情况来考虑
     * 为了接口通用性可以返回大量的无用数据
     * 也可以只返回客户端需要的数据，但这会造成有大量重复接口
     * 接口应当和业务绑定还是和实体绑定需要团队自己抉择
     * 此接口主要是为了返回分类下面的products，请对比products中的
     * 接口，这是一种不好的接口设计
     * @url /category/:id/products
     * @return Servicecategory single
     * @throws MissException
     */
    public function getServiceCategory($id)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $category = ServicecategoryModel::getServiceCategory($id);
        if (empty($category)) {
            throw new MissException([
                'msg' => 'category not found',
            ]);
        }
        return $category;
    }
}
