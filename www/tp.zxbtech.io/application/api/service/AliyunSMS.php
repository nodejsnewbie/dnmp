<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\service;

use Aliyun\DySDKLite\SignatureHelper;
use app\lib\exception\SMSException;
use think\Exception;
use think\facade\Env;

// Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
// Loader::import('Aliyun\DySDKLite\SignatureHelper', EXTEND_PATH);
require (Env::get('extend_path') . 'WxPay/WxPay.Api.php');

class AliyunSMS
{
    protected $mobile;
    protected $code;
    public function __construct($mobile, $code)
    {
        $this->mobile = $mobile;
        $this->code = $code;
    }
    public function sendSMS()
    {

        $params = array();

        // *** 需用户填写部分 ***

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        // $accessKeyId = "LTAIHTpm8kRg3qC5";
        $accessKeyId = config('aliyun.accessKeyId');
        // $accessKeySecret = "lJZVQQ6JMSNs6XFsXfJtE7oxYRD7Uv";
        $accessKeySecret = config('aliyun.accessKeySecret');
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $this->mobile;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = config('aliyun.SignName');

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = config('aliyun.TemplateCode');

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = array(
            "code" => $this->code,
        );

        // fixme 可选: 设置发送短信流水号
        // $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        // $params['SmsUpExtendCode'] = "1234567";

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        try {
            $content = $helper->request(
                $accessKeyId,
                $accessKeySecret,
                "dysmsapi.aliyuncs.com",
                array_merge($params, array(
                    "RegionId" => "cn-hangzhou",
                    "Action" => "SendSms",
                    "Version" => "2017-05-25",
                ))
            );
            if ($content->Message == "OK" && $content->Code == "OK") {
                $expire_in = config('setting.token_expire_in');
                $result = cache($this->mobile, $this->code, $expire_in);
                if (!$result) {
                    throw new TokenException([
                        'msg' => '服务器缓存异常',
                        'errorCode' => 10005,
                    ]);
                }

                return [
                    'code' => 200,
                    'msg' => '短消息已发送',
                    'msgCode' => 80000,
                ];
            } else {
                return [
                    'code' => 400,
                    'msg' => $content->Message,
                    'msgCode' => 90000,
                ];

            }

        } catch (Exception $ex) {
            throw new SMSException();
        }

    }

    // 签名
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string) time());
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }

}
