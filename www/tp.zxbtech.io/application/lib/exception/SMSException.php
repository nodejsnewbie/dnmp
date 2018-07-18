<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\lib\exception;


class SMSException extends BaseException
{
    public $code = 404;
    public $msg = '短信发送失败';
    public $errorCode = 80000;
}