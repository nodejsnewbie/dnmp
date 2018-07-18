<?php
/**
 * Created by 林原
 * Author: 林原
 */

namespace app\lib\exception;


class BrandException extends BaseException
{
    public $code = 404;
    public $msg = '指定品牌不存在，请检查品牌ID';
    public $errorCode = 20000;
}