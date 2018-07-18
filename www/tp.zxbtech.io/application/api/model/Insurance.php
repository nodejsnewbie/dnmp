<?php
/**
 * Created by 林原.
 * User: 林原
 */

namespace app\api\model;


use app\lib\exception\ProductException;
use app\lib\exception\InsuranceException;
use think\Model;

class Insurance extends BaseModel
{
    protected $hidden = ['delete_time', 'topic_img_id'];

    /**
     * 关联投保人信息
     * 要注意belongsTo和hasOne的区别
     * 带外键的表一般定义belongsTo，另外一方定义hasOne
     */
    public function policyHolder()
    {
        return $this->belongsTo('PolicyHolder', 'policy_holder_id', 'id');
    }


    /**
     * 关联device，1对1关系
     */
    public function device()
    {
        return $this->belongsTo(
            'Device', 'device_id', 'id');
    }
 
}