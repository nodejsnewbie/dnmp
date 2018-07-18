<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\model;


use think\Model;

class ServiceImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'service_id'];
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}