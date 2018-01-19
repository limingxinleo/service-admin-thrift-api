<?php

namespace App\Controllers\Admin;

use App\Biz\Auth\User;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Common\Validator\Admin\UserListValidator;
use App\Controllers\AuthController;
use App\Core\Services\Error;
use App\Models\Role;
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

    public function listAction()
    {
        $data = $this->request->get();
        $validator = new UserListValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');

        $users = \App\Biz\Admin\User::getInstance()->userList($pageIndex, $pageSize);

        $result = [];
        foreach ($users as $user) {
            $roles = [];
            /** @var Role $role */
            foreach ($user->roles as $role) {
                $roles[] = [
                    'name' => $role->role_name,
                ];
            }
            $result[] = [
                'id' => $user->id,
                'nickname' => $user->nickname,
                'username' => $user->username,
                'avatar' => $user->avatar,
                'type' => $user->type,
                'typeName' => \App\Biz\Admin\User::getInstance()->getTypeName($user->type),
                'createdAt' => $user->created_at,
                'roles' => $roles,
            ];
        }

        return Response::success([
            'items' => $result
        ]);
    }
}
