<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\lib\exception;


class BusinessException extends BaseException
{
    public $code = 404;
    public $msg = '业务不存在';
    public $errorCode = 60000;
}