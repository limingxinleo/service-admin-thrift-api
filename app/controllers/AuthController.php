<?php
// +----------------------------------------------------------------------
// | 控制器基类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Controllers;

use App\Biz\Auth\User;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;

abstract class AuthController extends Controller
{
    public function initialize()
    {
    }

    public function beforeExecuteRoute()
    {
        $token = $this->request->get('token');
        if (empty($token)) {
            throw new BizException(ErrorCode::$ENUM_TOKEN_REQUIRED);
        }

        $user = User::getInstance()->getUserCache($token);
        
    }

    public function afterExecuteRoute()
    {
        // 在每一个找到的动作后执行
    }
}
