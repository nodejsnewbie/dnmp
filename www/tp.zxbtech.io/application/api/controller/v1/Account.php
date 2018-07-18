<?php

namespace app\api\controller\v1;

use app\api\service\Account as AccountService;
use app\api\service\AliyunSMS as SMSService;
use app\api\service\AppToken;
use app\api\service\Token as TokenService;
use app\api\validate\AppTokenGet;
use app\api\validate\LoginDo;
use app\api\validate\Register;
use app\api\validate\ServerTimestamp;
use app\api\validate\SMS as SMSValidate;
use app\lib\exception\ParameterException;

class Account
{

    /**
     * 用户登陆
     * api POST /login
     * @param string mobile 电话号码
     * @param string password 密码
     * @return json $result  {"token":"令牌"}
     */
    public function doLogin($mobile = '', $password = '')
    {
        (new LoginDo())->goCheck();
        $login = new AccountService($mobile, $password);
        $token = $login->get();
        return [
            'token' => $token,
        ];
    }

    /**
     * 获取服务器timestamp
     * api POST /getTimestamp
     * @param string mobile 手机号码
     * @return json $result  {"flag":"1","msg":"消息","serverTimestamp":"服务器时间戳"}
     */

    public function getServerTimestamp($mobile = '')
    {
        (new ServerTimestamp())->goCheck();
        $time = time();
        $sign = md5($mobile . $time);
        cache($mobile, $sign, 300);
        return (array('flag' => 1, 'msg' => $sign, 'serverTimestamp' => $time));
    }

    public function getVerifyCode($mobile = '', $signature = '')
    {
        (new SMSValidate())->goCheck();
        if ($signature == cache($mobile)) {
            $code = rand(1000, 9999);
            $sms = new SMSService($mobile, $code);
            return $sms->sendSMS();
        } else {
            return [
                'isValid' => 'false',
            ];

        }

    }

    /**
     * 用户注册
     * api POST /register
     * @param string mobile 手机号码
     * @param string password 密码
     * @param string verifyCode 验证码
     * @return json $result  {"token":"令牌"}
     */
    public function register($mobile = '', $password = '', $verifyCode = '')
    {
        (new Register())->goCheck();
        $account = new AccountService($mobile, $password);
        $token = $account->createOne($verifyCode);
        return [
            'token' => $token,
        ];

    }
    /**
     * 第三方应用获取令牌
     * api POST /app_token?
     * @param string ac=:ac
     * @param string se=:secret
     * @return json $result  {"token":"令牌"}
     */
    public function getAppToken($ac = '', $se = '')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET');
        (new AppTokenGet())->goCheck();
        $app = new AppToken();
        $token = $app->get($ac, $se);
        return [
            'token' => $token,
        ];
    }

    public function verifyToken($token = '')
    {
        if (!$token) {
            throw new ParameterException([
                'token不允许为空',
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid,
        ];
    }

}
