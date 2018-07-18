<?php

namespace app\api\model;

use think\Model;

class User extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'from', 'category_id', 'img_id',
        'create_time', 'update_time', 'summary','openid','user_login','user_pass','last_login_ip','last_login_time','user_email','mobile','listorder',
        'status','create_time','code','profile_id'];
//    protected $createTime = ;

    /**
     * 获取所有用户提供的服务类型
     */
    public function services()
    {
        return $this->morphMany('Business', 'servicetable','User');
    }

     public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function orders()
    {
        return $this->hasMany('Order', 'user_id', 'id');
    }

    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne('Profile','user_id');
    }

    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     */
    public static function getByOpenID($openid)
    {
        $user = User::where('openid', '=', $openid)
            ->find();
        return $user;
    }
}
