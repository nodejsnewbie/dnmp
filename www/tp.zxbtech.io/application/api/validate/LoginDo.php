<?php
namespace app\api\validate;

class LoginDo extends BaseValidate
{
    protected $rule = [
        'mobile' => 'require|isMobile',
        'password' => 'require|isNotEmpty'
    ];
    
    protected $message=[
        'mobile' => '手机号码无效',
        'password' => '密码不能为空'
    ];
}
