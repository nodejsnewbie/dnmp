<?php

namespace app\api\model;

use think\Model;

class Serviceorder extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;
    // protected $connection = 'db_config_product';
    public function getSnapAddressAttr($value)
    {
        if (empty($value)) {
            return null;
        }
        return json_decode(($value));
    }

    public static function getSummaryByUser($uid, $page = 1, $size = 15)
    {
        $pagingData = self::where('user_id', '=', $uid)
            ->order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }

    public static function getSummaryByPage($page = 1, $size = 20)
    {
        $pagingData = self::order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }

    public function service()
    {
        return $this->hasOne('Service');

    }

    public function user()
    {
        return $this->hasOne('User');

    }

    public function imgs()
    {
        return $this->hasMany('OrderImage', 'order_id', 'id');
    }

        /**
     * 获取订单详情
     * @param $id
     * @return null | ServiceOrder
     */
    public static function getServiceOrderDetail($id)
    {

        $order = self::with(
            [
                'imgs' => function ($query) {
                    $query->with(['imgUrl'])
                        ->order('order', 'asc');
                    },
            ]
        )
            ->find($id);
        return $order;
    }
}
