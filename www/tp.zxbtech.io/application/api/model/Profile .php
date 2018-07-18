<?php

namespace app\api\model;

use think\Model;

class Profile extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $hidden = [
        'delete_time', 'signature', 'pivot', 'user_activation_key', 'category_id', 'img_id',
        'create_time', 'update_time', 'summary', 'openid', 'user_login', 'user_pass', 'last_login_ip', 'last_login_time', 'user_email', 'mobile', 'listorder',
        'status', 'extend', 'create_time'];
    public function user()
    {
        return $this->belongsTo('User');
    }

}
