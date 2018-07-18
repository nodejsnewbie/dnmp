<?php
/**
 * Created by 林原
 * User: 林原
 */
namespace app\api\validate;

class ServerTimestamp extends BaseValidate
{
    protected $rule = [
        'mobile' => 'require|isMobile'
    ];
    
    protected $message=[
        'mobile' => '请输入正确的手机号码'
    ];
}
