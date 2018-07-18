<?php

namespace app\api\model;

use think\Model;

class Servicecategory extends BaseModel
{
   protected $hidden = ['delete_time', 'update_time'];

    public function services()
    {
        return $this->hasMany('Service', 'category_id', 'id');
    }

 public function img()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

 public static function getServiceCategory($id)
    {
        $service = self::with('img')
            ->with('services')
            ->with('services.imgs')
            ->find($id);
        return $service;
    }
}
