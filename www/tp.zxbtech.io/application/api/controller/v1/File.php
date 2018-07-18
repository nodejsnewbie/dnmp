<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\lib\exception\WeChatException;
use think\Controller;

class File extends BaseController
{
    // protected $beforeActionList = [
    //     'checkExclusiveScope' => ['only' => 'upload']
    // ];

    public function upload()
    {
        try {

            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('image');
            $info = $file->validate(['size' => 31356, 'ext' => 'jpg,png,gif']);
            if ($info) {
                $result = $info->move('../public/images/uploads', '');
                if ($result) {
                    return ['code' => 201, 'errorCode' => 0, 'filename' => '/images/uploads/' . $result->getFilename()];
                } else {
                    throw new WeChatException(['msg' => $info->getError()]);

                }

            } else {
                // 上传失败获取错误信息
                // return ['msg'=>$file->getError(),];
                throw new WeChatException(['msg' => $file->getError()]);

            }
        } catch (WeChatException $e) {
            throw $e;
        } catch (\Throwable | \Error | \Exception $e) {
            throw new WeChatException();
        }
    }
}
