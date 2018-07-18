<?php

namespace app\api\model;

use think\Model;

class Merchant extends BaseModel
{
    protected $autoWriteTimestamp = 'datetime';
    protected $hidden = [
        'delete_time', 'img_id', 'pivot', 'from', 'category_id',
        'create_time', 'update_time'];

/**
 * 获取所有商户提供的服务类型
 */
    public function services()
    {
        return $this->morphMany('Business', 'servicetable', 'Merchant');
    }

    /**
     * 图片属性
     */
    public function imgs()
    {
        return $this->hasMany('MerchantImage', 'merchant_id', 'id');

    }

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function properties()
    {
        return $this->hasMany('MerchantProperty', 'merchant_id', 'id');
    }

    /**
     * 获取商户详情
     * @param $id
     * @return null | Merchant
     */
    public static function getMerchantDetail($id)
    {
        //千万不能在with中加空格,否则你会崩溃的
            //    $merchant = self::with(['imgs' => function($query){
            //           $query->order('index','asc');
            //        }])
            //        ->with('properties,imgs.imgUrl')
            //        ->find($id);
            //    return $merchant;

        $merchant = self::with(['imgs' => function ($query)
                                             {
                                                 $query->with(['imgUrl'])
                                                    ->order('order', 'asc');
                                             }
                               ])->with('properties')
                               ->find($id);
        // $merchant = self::where('id', '=', $id)
        //     ->find();
        return $merchant;
    }
    /**
     * 根据分类id获取商户列表信息
     * @param $id
     * @return null | Merchant
     */
    public static function getMerchantsByCategoryID($id)
    {
        $merchant = self::with(
            [
                'imgs' => function ($query) {
                    $query->with(['imgUrl'])
                        ->order('order', 'asc');
                }])
            ->with('properties')
            ->find($id);
        return $merchant;
    }
    /**
     * 根据商户id获取商户服务列表
     * @param $id
     * @return null | Merchant
     */
    public static function getServices($id)
    {
        $merchant = self::getMerchantDetail($id);
        // foreach ($merchant->services as $service) {
        //     dump($service);
        // }
        return $merchant->services;
    }

    public static function getMostRecent($count)
    {
        $merchants = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $merchants;
    }

}
