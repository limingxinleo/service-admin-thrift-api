<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Role;
use App\Common\Enums\ErrorCode;
use App\Common\Validator\Admin\RoleAddValidator;
use App\Common\Validator\Admin\RoleListValidator;
use App\Controllers\Controller;
use App\Core\Services\Error;
use App\Utils\Response;

class RoleController extends Controller
{
    public function listAction()
    {
        $data = $this->request->get();
        $validator = new RoleListValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');

        $items = Role::getInstance()->roles($pageIndex, $pageSize);
        $result = [];
        foreach ($items as $item) {
            $result[] = [
                'id' => $item->id,
                'roleName' => $item->role_name,
                'roleDesc' => $item->role_desc,
                'createdAt' => $item->created_at,
            ];
        }

        return Response::success([
            'items' => $result
        ]);
    }

    public function saveAction()
    {
        $data = $this->request->get();
        $validator = new RoleAddValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $roleName = $validator->getValue('roleName');
        $roleDesc = $validator->getValue('roleDesc');

        $result = Role::getInstance()->save([
            'roleName' => $roleName,
            'roleDesc' => $roleDesc,
        ]);

        if ($result) {
            return Response::success();
        }

        return Response::fail(ErrorCode::$ENUM_ROLE_ADD_FAIL);
    }
}
