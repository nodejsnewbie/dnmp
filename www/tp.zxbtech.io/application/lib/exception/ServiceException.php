<?php
/**
 * Created by 林原
 * Author: 林原
 */

namespace app\lib\exception;


class ServiceException extends BaseException
{
    public $code = 404;
    public $msg = '指定服务不存在，请检查服务ID';
    public $errorCode = 30000;
}