<?php
namespace app\api\validate;

class Register extends BaseValidate
{
    protected $rule = [
        'mobile' => 'require|isMobile|unique:user',
        'password' => 'require|isNotEmpty|max:20|min:5',
        'verifyCode' =>'require|isNotEmpty'
    ];
    
    protected $message=[
        'mobile' => '手机号码无效或已被注册',
        'password' => '密码长度应为5到20位',
        'verifyCode' => '手机验证码不能为空'
    ];
}