<?php
/**
 */

namespace app\api\model;


use think\Model;

class OrderImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'order_id'];
    // protected $connection = 'db_config_product';
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}