<?php

namespace app\lib\exception;
use think\Exception;

/**
 * 微信服务器异常
 */
class LoginException extends BaseException
{
    public $code = 400;
    public $msg = '账号不存在或密码错误';
    public $errorCode = 999;
}