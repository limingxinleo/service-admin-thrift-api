<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Role;
use App\Biz\Auth\User;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Common\Validator\Admin\UpdateUserRoleValidator;
use App\Common\Validator\Admin\UserAddValidator;
use App\Common\Validator\Admin\UserListValidator;
use App\Common\Validator\Admin\UserRolesValidator;
use App\Controllers\AuthController;
use App\Models\Role as RoleModel;
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
            /** @var RoleModel $role */
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

    public function saveAction()
    {
        $data = $this->request->get();
        $validator = new UserAddValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $username = $validator->getValue('username');
        $nickname = $validator->getValue('nickname');
        $email = $validator->getValue('email');
        $mobile = $validator->getValue('mobile');
        $id = $validator->getValue('id');

        $result = \App\Biz\Admin\User::getInstance()->save([
            'id' => $id,
            'username' => $username,
            'nickname' => $nickname,
            'email' => $email,
            'mobile' => $mobile,
        ]);

        if ($result) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_ADMIN_ADD_FAIL);
    }

    public function rolesAction()
    {
        $data = $this->request->get();
        $validator = new UserRolesValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $userId = $validator->getValue('userId');
        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');

        $user = \App\Biz\Admin\User::getInstance()->info($userId);

        if (empty($user)) {
            return Response::fail(ErrorCode::$ENUM_ADMIN_NOT_EXIST);
        }

        $roles = $user->roles->toArray();
        $mine = array_column($roles, 'id');

        $roles = Role::getInstance()->roles($pageIndex, $pageSize);

        $result = [];
        $count = Role::getInstance()->count();
        foreach ($roles as $role) {
            $result[] = [
                'id' => $role->id,
                'roleName' => $role->role_name,
                'roleDesc' => $role->role_desc,
                'bound' => in_array($role->id, $mine)
            ];
        }

        return Response::success([
            'items' => $result,
            'total' => $count
        ]);
    }

    public function updateRoleAction()
    {
        $data = $this->request->get();
        $validator = new UpdateUserRoleValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $userId = $validator->getValue('userId');
        $roleId = $validator->getValue('roleId');

        $result = \App\Biz\Admin\User::getInstance()->updateRole($userId, $roleId);

        if ($result) {
            return Response::success();
        }

        return Response::fail(ErrorCode::$ENUM_ADMIN_BIND_ROLE_FAIL);
    }
}
