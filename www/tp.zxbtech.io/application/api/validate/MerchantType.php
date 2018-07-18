<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\validate;


class MerchantType extends BaseValidate
{
    protected $rule = [
        'type' => 'require|isNotEmpty',
    ];
     
    protected $message=[
        'type' => '服务类型不能为空',
    ];
}