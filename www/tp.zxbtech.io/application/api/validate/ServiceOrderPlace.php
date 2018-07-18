<?php
/**
 */

namespace app\api\validate;

use app\lib\exception\ParameterException;

class ServiceOrderPlace extends BaseValidate
{
    // protected $rule = [
    //     'service_id' => 'require|isPositiveInteger',
    //     'service_name' => 'require|isNotEmpty',
    //     'service_type_id' => 'require|isPositiveInteger',
    //     'service_type' => 'require|isNotEmpty',
    //     'brand_id' => 'require|isPositiveInteger',
    //     'brand_name' => 'require|isNotEmpty',
    //     'arrive_time' => 'require|isNotEmpty',
    //     'order_time' => 'require|isNotEmpty',
    //     'warranty' => 'require|isNotEmpty',
    //     'delegate_type' => 'require|isNotEmpty',
    //     'tempFilePaths' => 'require|isNotEmpty',
    //     'status' => 'require|isNotEmpty'
    // ];

    protected $rule = [
        'service' => 'checkService',
    ];

    protected $singleRule = [
       'service_id' => 'require|isPositiveInteger',
        'service_name' => 'require|isNotEmpty',
        'service_type_id' => 'require|isPositiveInteger',
        'service_type' => 'require|isNotEmpty',
        'brand_id' => 'require|isPositiveInteger',
        'brand_name' => 'require|isNotEmpty',
        'arrive_time' => 'require|isNotEmpty',
        'order_time' => 'require|isNotEmpty',
        'warranty' => 'require|isNotEmpty',
        'delegate_type' => 'require|isNotEmpty',
        // 'tempFilePaths' => 'require|isNotEmpty',
        // 'status' => 'require|isNotEmpty'
    ];

    protected function checkService($value)
    {
        if (empty($value)) {
            throw new ParameterException([
                'msg' => '服务不能为空',
            ]);
        }
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if (!$result) {
            throw new ParameterException([
                'msg' => '服务列表参数错误',
            ]);
        }

        return true;
    }
}
