<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\model;


class ServiceProperty extends BaseModel
{
    protected $hidden=['product_id', 'delete_time', 'id'];

      /**
     * 获取某服务的属性
     * @param $serviceID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getPropertiesByServiceID(
        $serviceID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::
        where('service_id', '=', $serviceID);
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