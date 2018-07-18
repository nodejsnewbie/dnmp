<?php

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    protected $hidden = ['delete_time', 'id', 'from','update_time'];
    // protected $connection = 'db_config_product';
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function orderImages()
    {
        return $this->hasMany('OrderImage','img_id');
    }
}

