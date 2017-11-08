<?php
// +----------------------------------------------------------------------
// | 默认控制器 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
namespace App\Controllers;

use App\Common\Enums\ErrorCode;
use App\Logics\System;
use App\Utils\Response;

class IndexController extends Controller
{

    public function indexAction()
    {
        return Response::fail(ErrorCode::$ENUM_SYSTEM_ERROR);
    }
}