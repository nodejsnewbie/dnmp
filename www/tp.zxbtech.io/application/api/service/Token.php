<?php
/**
 */

namespace app\api\service;

use app\api\model\User;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\ParameterException;
use app\lib\exception\TokenException;
use Cache;
use Request;
use think\Exception;

class Token
{

    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('secure.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }

    //验证token是否合法或者是否过期
    //验证器验证只是token验证的一种方式
    //另外一种方式是使用行为拦截token，根本不让非法token
    //进入控制器
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    // 用户专有权限
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    public static function needSuperScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::Super) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    public static function getCurrentTokenVar($key)
    {
        $token = Request::header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            } else {
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }

    /**
     * 从缓存中获取当前用户指定身份标识
     * @param array $keys
     * @return array result
     * @throws \app\lib\exception\TokenException
     */
    public static function getUserIdentity()
    {
        $token = Request::header('token');
        $identities = Cache::get($token);
        //cache 助手函数有bug
        //        $identities = cache($token);
        if (!$identities) {
            throw new TokenException();
        } else {
            $identities = json_decode($identities, true);
            $uid = $identities['uid'];
            $scope = $identities['scope'];
            $role = null;
            switch ($scope) {
                case ScopeEnum::User:
                    $role = 'user';
                    break;
                case ScopeEnum::Super:
                    $role = 'admin';
                    break;
                default: throw  new TokenException();
            }
            $result=[
                'role'=>[$role],
                'introduction'=>'',
                'token'=>'',
                'name'=>'',
                'uid'=>$uid
            ];
        }
return $result;
    }

    /**
     * 从缓存中获取当前用户指定身份标识
     * @param array $keys
     * @return array result
     * @throws \app\lib\exception\TokenException
     */
    public static function getCurrentIdentity($keys)
    {
        $token = Request::header('token');
        $identities = Cache::get($token);
        //cache 助手函数有bug
        //        $identities = cache($token);
        if (!$identities) {
            throw new TokenException();
        } else {
            $identities = json_decode($identities, true);
            $result = [];
            foreach ($keys as $key) {
                if (array_key_exists($key, $identities)) {
                    $result[$key] = $identities[$key];
                }
            }
            return $result;
        }
    }

    /**
     * 当需要获取全局UID时，应当调用此方法
     *而不应当自己解析UID
     *
     */
    public static function getCurrentUid()
    {
        $key = 'uid';
        $token = Request::header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (!array_key_exists($key, $vars)) {
                $key = 'app_id';
            }
        }

        $uid = self::getCurrentTokenVar($key);
        $scope = self::getCurrentTokenVar('scope');
        if ($scope == ScopeEnum::Super) {
            // 只有Super权限才可以自己传入uid
            // 且必须在get参数中，post不接受任何uid字段
            $userID = input('get.uid');
            if (!$userID) {
                throw new ParameterException(
                    [
                        'msg' => '没有指定需要操作的用户对象',
                    ]);
            }
            return $userID;
        } else {
            return $uid;
        }
    }

    /**
     * 检查操作UID是否合法
     * @param $checkedUID
     * @return bool
     * @throws Exception
     * @throws ParameterException
     */
    public static function isValidOperate($checkedUID)
    {
        if (!$checkedUID) {
            throw new Exception('检查UID时必须传入一个被检查的UID');
        }
        $currentOperateUID = self::getCurrentUid();
        if ($currentOperateUID == $checkedUID) {
            return true;
        }
        return false;
    }

    public static function verifyToken($token)
    {
        $exist = Cache::get($token);
        if ($exist) {
            return true;
        } else {
            return false;
        }
    }

    public function prepareCachedValue($value, $uid)
    {
        $cachedValue = $value;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }

    // 写入缓存
    public function saveToCache($value)
    {
        $key = self::generateToken();
        $value = json_encode($value);
        $expire_in = config('setting.token_expire_in');
        $result = cache($key, $value, $expire_in);

        if (!$result) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005,
            ]);
        }
        return $key;
    }

    // 颁发令牌
    // 只要调用登陆就颁发新令牌
    // 但旧的令牌依然可以使用
    // 所以通常令牌的有效时间比较短
    // 目前微信的express_in时间是7200秒
    // 在不设置刷新令牌（refresh_token）的情况下
    // 只能延迟自有token的过期时间超过7200秒（目前还无法确定，在express_in时间到期后
    // 还能否进行微信支付
    // 没有刷新令牌会有一个问题，就是用户的操作有可能会被突然中断
    public function grantToken($openid)
    {
        // 此处生成令牌使用的是TP5自带的令牌
        // 如果想要更加安全可以考虑自己生成更复杂的令牌
        // 比如使用JWT并加入盐，如果不加入盐有一定的几率伪造令牌
        //        $token = Request::instance()->token('token', 'md5');
        $user = User::getByOpenID($openid);
        if (!$user)
        // 借助微信的openid作为用户标识
        // 但在系统中的相关查询还是使用自己的uid
        {
            $uid = $this->newUser($openid);
        } else {
            $uid = $user->id;
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    public function getUID($openid)
    {
        $user = User::getByOpenID($openid);
        if (!$user)
        // 借助微信的openid作为用户标识
        // 但在系统中的相关查询还是使用自己的uid
        {
            $uid = $this->newUser($openid);
        } else {
            $uid = $user->id;
        }
        return $uid;
    }

    // 创建新用户
    private function newUser($openid)
    {
        // 有可能会有异常，如果没有特别处理
        // 这里不需要try——catch
        // 全局异常处理会记录日志
        // 并且这样的异常属于服务器异常
        // 也不应该定义BaseException返回到客户端
        $user = User::create(
            [
                'openid' => $openid,
            ]);
        return $user->id;
    }
}
