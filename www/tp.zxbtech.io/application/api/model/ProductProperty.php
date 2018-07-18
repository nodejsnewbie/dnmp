<?php
/**
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden=['product_id', 'delete_time', 'id'];

      /**
     * 获取某产品的属性
     * @param $productID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getPropertiesByProductID(
        $productID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::
        where('product_id', '=', $productID);
        if (!$paginate)
        {
            return $query->select();
        }
        else
        {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, true, [
                'page' => $page
            ]);
        }
    }
}