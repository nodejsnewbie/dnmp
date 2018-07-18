<?php
namespace app\api\controller\v1;

use app\api\model\ProductProperty as ProductPropertyModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\ProductPropertyNew;
use app\lib\exception\ParameterException;
use app\lib\exception\ProductException;
use app\lib\exception\ThemeException;
use think\Controller;
use think\Exception;

class ProductProperty extends Controller
{
    protected $beforeActionList = [
        'checkSuperScope' => ['only' => 'createOne,deleteOne']
    ];
    
    /**
     * 根据产品ID获取该产品所有属性(分页）
     * @url /productPropertyProperty?id=:productProperty_id&page=:page&size=:page_size
     * @param int $id 商品id
     * @param int $page 分页页数（可选)
     * @param int $size 每页数目(可选)
     * @return array of ProductProperty
     * @throws ParameterException
     */
    public function getByProduct($id = -1, $page = 1, $size = 30)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $pagingProperties = ProductPropertyModel::getPropertiesByProductID(
            $id, true, $page, $size);
        if ($pagingProperties->isEmpty())
        {
            // 对于分页最好不要抛出MissException，客户端并不好处理
            return [
                'current_page' => $pagingProducts->currentPage(),
                'data' => []
            ];
        }
        //数据集对象和普通的二维数组在使用上的一个最大的区别就是数据是否为空的判断，
        //二维数组的数据集判断数据为空直接使用empty
        //collection的判空使用 $collection->isEmpty()

        // 控制器很重的一个作用是修剪返回到客户端的结果

        //        $t = collection($productPropertys);
        //        $cutProducts = collection($productPropertys)
        //            ->visible(['id', 'name', 'img'])
        //            ->toArray();

//        $collection = collection($pagingProducts->items());
        $data = $pagingProducts
            ->hidden(['summary'])
            ->toArray();
        // 如果是简洁分页模式，直接序列化$pagingProducts这个Paginator对象会报错
        //        $pagingProducts->data = $data;
        return [
            'current_page' => $pagingProducts->currentPage(),
            'data' => $data
        ];
    }

    

    public function createOne()
    {
        $validate = new ProductPropertyNew();
        $validate->goCheck();
        $data = $validate->getDataByRule(input('post.'));
        $productProperty = new ProductPropertyModel();
        $productProperty->save($data);
    }

    public function deleteOne($id)
    {
        ProductPropertyModel::destroy($id);
        //        ProductModel::destroy(1,true);
    }

}