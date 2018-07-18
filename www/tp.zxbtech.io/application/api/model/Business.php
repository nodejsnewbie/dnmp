<?php

namespace app\api\model;

use think\Model;

class Business extends BaseModel
{
    protected $autoWriteTimestamp = 'datetime';
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'from', 'category_id', 'img_id',
        'create_time', 'update_time', 'summary'];

    /**
     * 获取业务对应的多态模型。
     */
    public function servicetable()
    {
        return $this->morphTo();
    }

    /**
     * 图片属性
     */
    public function imgs()
    {
        return $this->hasMany('ServiceImage', 'service_id', 'id');
    }

    /**
     * 服务描述属性
     */
    public function serviceTypes()
    {
        return $this->hasMany('ServiceType', 'service_id', 'id');
    }

    /**
     * 品牌属性
     */
    public function brands()
    {
        return $this->hasMany('Brand', 'service_id', 'id');
    }

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function properties()
    {
        return $this->hasMany('ServiceProperty', 'service_id', 'id');
    }

    /**
     * 获取某分类下商品
     * @param $categoryID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getServicesByCategoryID(
        $categoryID, $paginate = true, $page = 1, $size = 30) {
        $query = self::
            where('category_id', '=', $categoryID);
        if (!$paginate) {
            return $query->select();
        } else {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, true, [
                    'page' => $page,
                ]);
        }
    }

    /**
     * 获取商品详情
     * @param $id
     * @return null | Service
     */
    public static function getServiceDetail($id)
    {
        //千万不能在with中加空格,否则你会崩溃的
        //        $service = self::with(['imgs' => function($query){
        //               $query->order('index','asc');
        //            }])
        //            ->with('properties,imgs.imgUrl')
        //            ->find($id);
        //        return $service;

        $service = self::with('serviceTypes')
            ->with('brands')
            ->find($id);
        return $service;
    }

    public static function getMostRecent($count)
    {
        $services = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $services;
    }

    /**
     * 根据服务id及商户类型获取业务信息
     * @param $id
     * @param $type  商户类型
     * @return null | Merchant
     */
    public static function getByService($id,$type)
    {
        $businesses = self::where('service_id', $id)
            ->where('servicetable_type',$type)
            ->select();
        return $businesses;

    }
}
