<?php
/**
 */

namespace app\api\controller\v1;

use mumbaicat\makeapidoc\ApiDoc;
// 1.6
/**
 * Doc资源
 */
class Doc 
{
    public function getDoc()
    {
        $doc = new ApiDoc('../application'); //参数1是代码目录，参数2是保存路径，参数2默认是当前路径。
        $doc->setName('api'); //设置项目名称，不写此行默认是api，生成 项目名称.html 的文件，注意保存路径下是否有同名的文件，会被覆盖。
        $doc->make(); //生成

    }
}
