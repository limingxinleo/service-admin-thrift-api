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
use App\Common\Enums\SystemCode;

abstract class AuthController extends Controller
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();

        if (!$this->request->hasHeader('X-AUTH-TOKEN')) {
            throw new BizException(ErrorCode::$ENUM_TOKEN_REQUIRED);
        }
        $token = $this->request->getHeader('X-AUTH-TOKEN');

        $user = User::getInstance()->getUserCache($token);

        if ($user->type !== SystemCode::ADMIN_USER_SUPER_TYPE) {
            // 非超级管理员，判断管理员是否有权限访问

            throw new BizException(ErrorCode::$ENUM_ILLEGAL_REQUEST);
        }
    }

    public function afterExecuteRoute()
    {
        // 在每一个找到的动作后执行
    }
}
