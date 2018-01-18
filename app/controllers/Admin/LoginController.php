<?php

namespace App\Controllers\Admin;

use App\Biz\Auth\User;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Common\Validator\Admin\LoginValidator;
use App\Controllers\Controller;
use App\Utils\Response;

class LoginController extends Controller
{
    public function loginAction()
    {
        $validator = new LoginValidator();

        if ($validator->validate($this->request->get())->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $username = $validator->getValue('username');
        $password = $validator->getValue('password');

        if (!User::getInstance()->login($username, $password)) {
            // 登录失败
            return Response::fail(ErrorCode::$ENUM_PASSWORD_INVALID);
        }

        return Response::success([
            'token' => User::getInstance()->token
        ]);
    }
}
