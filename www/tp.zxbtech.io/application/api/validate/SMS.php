<?php
namespace app\api\validate;

class SMS extends BaseValidate
{
    protected $rule = [
        'mobile' => 'require|isMobile',
        'signature' => 'require|isNotEmpty'
    ];
    
    protected $message=[
        'mobile' => '手机号码无效',
        'signature' => '签名不能为空'
    ];
}