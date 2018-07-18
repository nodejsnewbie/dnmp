<?php
namespace app\api\validate;

class ProductPropertyNew extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty',
        'product_id' => 'require|isNotEmpty'
    ];
}
