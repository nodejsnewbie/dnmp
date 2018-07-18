<?php

namespace app\api\service;

use app\api\model\ThirdApp;
use app\lib\enum\ScopeEnum;
use app\lib\exception\UserException;
use Cache;
/**
 * 手机号密码登录
 * 如果担心频繁被恶意调用，请限制ip
 * 以及访问频率
 */
class Account extends Token
{
    protected $mobile;
    protected $password;
    public function __construct($mobile, $password)
    {
        $this->mobile = $mobile;
        $this->password = $password;
    }

    /**
     * 登陆
     * 思路1：每次都查询数据库判断用户是否存在，生成新的Token，不删除旧的Token
     * 思路2：检查Token有没有过期，没有过期则直接返回当前Token
     * 思路3：重新去查询数据库并删除当前Token，返回新的Token
     */
    public function get()
    {
        $user = $this->getUser($this->mobile, $this->password);
        return $this->grantToken($user);
    }

    /**
     * 创建用户
     */

    public function createOne($code)
    {
        $verifyCode = Cache::get($this->mobile);
        $verifyCode ='9692';//todo 为了方便测试而设定了固定验证码，应当删除
        if ($verifyCode == $code) {
            $user = ThirdApp::create(
                [   'app_id'=>$this->mobile,
                    'app_secret' => password_hash($this->password, PASSWORD_DEFAULT),
                    'scope' =>ScopeEnum::User,
                ]);
            $uid = $this->getUID($this->mobile);
            $values = [
                    'scope' =>ScopeEnum::User,
                    'uid' => $uid,
                ];
                // $cachedValue = $this->prepareCachedValue($values, $uid);
                $token = $this->saveToCache($values);
                return $token;
        } else {
            throw new UserException(
                ['code' => 404,
                    'msg' => '验证码错误',
                    'errorCode' => 70001,
                ]);

        }
    }

    public static function generateVerifyCode($mobile)
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $verifyCode =
        $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
            'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
            '%02d', rand(0, 99));
        self::saveToCache($mobile, $verifyCode);
        return $verifyCode;
    }

    private function getUser($mobile, $password)
    {
        $user = User::where('mobile', '=', $this->mobile)
            ->find();
        if (!$user) {
            throw new UserException(
                [
                    'msg' => '账号不存在或密码错误',
                    'errorCode' => 70000,
                ]);

        }

        if (password_verify($password, $user['user_pass'])) {
            return $user->toArray();
        } else {
            throw new UserException(
                [
                    'msg' => '账号不存在或密码错误',
                    'errorCode' => 70000,
                ]);

        }
    }

    // 判断是否重复获取
    private function duplicateFetch()
    {
        //TODO:目前无法简单的判断是否重复获取，还是需要去微信服务器去openid
        //TODO: 这有可能导致失效行为
    }

    // // 写入缓存
    // private function saveToCache($key, $value)
    // {
    //     $expire_in = config('setting.token_expire_in');
    //     $result = cache($key, $value, $expire_in);

    //     if (!$result) {
    //         throw new TokenException([
    //             'msg' => '服务器缓存异常',
    //             'errormobile' => 10005,
    //         ]);
    //     }
    //     return $key;
    // }

    // 颁发令牌
    public function grantToken($user)
    {
        // 此处生成令牌使用的是TP5自带的令牌
        // 如果想要更加安全可以考虑自己生成更复杂的令牌
        // 比如使用JWT并加入盐，如果不加入盐有一定的几率伪造令牌
        //        $token = Request::instance()->token('token', 'md5');
        $cachedValue = $user;
        $cachedValue['scope'] = ScopeEnum::User;
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $token = $this->saveToCache($key, $value);
        return $token;
    }

    // private function prepareCachedValue($value, $uid)
    // {
    //     $cachedValue = $value;
    //     $cachedValue['uid'] = $uid;
    //     $cachedValue['scope'] = ScopeEnum::User;
    //     return $cachedValue;
    // }

}
