<?php
namespace app\portal\controller;

use cmf\controller\HomeBaseController;

class TestController extends HomeBaseController
{
    public function index()
    {
        return cmf_password('666666');
    }
}
