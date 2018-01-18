<?php

namespace App\Controllers\Admin;

use App\Biz\Auth\User;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Controllers\AuthController;
use App\Utils\Response;

class UserController extends AuthController
{
    public function infoAction()
    {
        /** @var \App\Models\User $user */
        $user = User::getInstance()->user;
        return Response::success([
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
        ]);
    }

    public function logoutAction()
    {
        if (!User::getInstance()->logout()) {
            throw new BizException(ErrorCode::$ENUM_LOGOUT_FAIL);
        }
        return Response::success([]);
    }
}
