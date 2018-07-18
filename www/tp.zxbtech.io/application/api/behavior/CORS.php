<?php
/**
 * Created by 林原.
 * Author: 林原
 */

namespace app\api\behavior;


use Response;

class CORS
{
    public function appInit($params)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
    }
}