<?php

namespace app\api\model;

use think\Model;

class ServiceType extends BaseModel
{
    protected $autoWriteTimestamp = 'datetime';
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'from', 'service_id',
        'create_time', 'update_time'];
    /**
     * 获取某分类下的服务描述
     * @param $serviceID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getServiceTypesByServiceID(
        $serviceID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::where('service_id', '=', $serviceID);
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
