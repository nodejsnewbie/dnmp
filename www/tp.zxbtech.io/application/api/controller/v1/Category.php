<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\controller\v1;

// require 'vendor/autoload.php';

use app\api\controller\BaseController;
use app\api\model\Category as CategoryModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\Controller;

class Category extends BaseController
{
    /**
     * 获取全部类目列表，但不包含类目下的商品
     * Request 演示依赖注入Request对象
     * @url /category/all
     * @return array of Categories
     * @throws MissException
     */
    public function getAllCategories()
    {
        $categories = CategoryModel::all([], 'imgs');
        if (empty($categories)) {
            throw new MissException([
                'msg' => '还没有任何类目',
                'errorCode' => 50000,
            ]);
        }
        return $categories;
    }

    public function getCategoriesFile()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        return ['msg' => 'file saved'];
    }
    public function getCategories()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template.xlsx');

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('A1')->setValue('John');
        $worksheet->getCell('A2')->setValue('Smith');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('write.xls');

        return ['msg' => 'file saved'];
    }

    /**
     * 这里没有返回类目的关联属性比如类目图片
     * 只返回了类目基本属性和类目下的所有商品
     * 返回什么，返回多少应该根据团队情况来考虑
     * 为了接口通用性可以返回大量的无用数据
     * 也可以只返回客户端需要的数据，但这会造成有大量重复接口
     * 接口应当和业务绑定还是和实体绑定需要团队自己抉择
     * 此接口主要是为了返回分类下面的products，请对比products中的
     * 接口，这是一种不好的接口设计
     * @url /category/:id/products
     * @return Category single
     * @throws MissException
     */
    public function getCategory($id)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $category = CategoryModel::getCategory($id);
        if (empty($category)) {
            throw new MissException([
                'msg' => 'category not found',
            ]);
        }
        return $category;
    }
}
