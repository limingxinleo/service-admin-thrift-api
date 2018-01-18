<?php

namespace App\Controllers\Admin;

use App\Biz\Auth\User;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Controllers\Controller;
use App\Utils\Response;

class LoginController extends Controller
{
    public function loginAction()
    {
        $username = $this->request->get('username');
        $password = $this->request->get('password');

        if (!User::getInstance()->login($username, $password)) {
            // 登录失败
            throw new BizException(ErrorCode::$ENUM_PASSWORD_INVALID);
        }

        return Response::success([
            'token' => User::getInstance()->token
        ]);
    }
}
