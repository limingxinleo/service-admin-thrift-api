<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Role;
use App\Common\Validator\Admin\RoleListValidator;
use App\Controllers\Controller;
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

    }

}

