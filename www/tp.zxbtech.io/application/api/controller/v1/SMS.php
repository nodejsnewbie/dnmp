<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use think\Controller;
use app\api\service\AliyunSMS as SMSService;
use app\api\validate\SMS as SMSValidate;


class SMS extends BaseController
{
    public function sendSMS($mobile='', $code='')
    {
         (new SMSValidate())->goCheck();
        $sms = new SMSService($mobile, $code);
        return $sms->sendSMS();

        
    }

}
