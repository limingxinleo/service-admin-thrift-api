<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Role;
use App\Biz\Admin\Router;
use App\Common\Enums\ErrorCode;
use App\Common\Enums\SystemCode;
use App\Common\Validator\Admin\RoleAddValidator;
use App\Common\Validator\Admin\RoleListValidator;
use App\Common\Validator\Admin\RoleRoutersValidator;
use App\Common\Validator\Admin\UpdateRoleRouterValidator;
use App\Controllers\AuthController;
use App\Core\System;
use App\Utils\Response;

class RoleController extends AuthController
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
        $count = Role::getInstance()->count();

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
            'items' => $result,
            'total' => $count
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

    public function routersAction()
    {
        $data = $this->request->get();
        $validator = new RoleRoutersValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $id = $validator->getValue('id');
        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');
        $searchText = $validator->getValue('searchText');
        $searchType = $validator->getValue('searchType');

        if ($searchType == SystemCode::ADMIN_ROUTER_SEARCH_TYPE_ALL) {
            $routers = Role::getInstance()->routers($id);
            $routes = [];
            foreach ($routers as $router) {
                $routes[] = $router->id;
            }

            $routers = Router::getInstance()->routes([
                'searchText' => $searchText,
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
            ]);
            $count = Router::getInstance()->count([
                'searchText' => $searchText,
            ]);
        } else {
            $role = Role::getInstance()->info($id);
            $routers = $role->routers($pageIndex, $pageSize, $searchText);

            $count = Role::getInstance()->routersCount($id, [
                'searchText' => $searchText
            ]);
        }

        $total = [];
        foreach ($routers as $router) {
            $bound = $searchType == SystemCode::ADMIN_ROUTER_SEARCH_TYPE_BOUND ?: in_array($router->id, $routes);
            $total[] = [
                'id' => $router->id,
                'name' => $router->name,
                'route' => $router->route,
                'bound' => $bound,
            ];
        }

        return Response::success([
            'list' => $total,
            'total' => $count
        ]);
    }

    public function updateRouterAction()
    {
        $data = $this->request->get();
        $validator = new UpdateRoleRouterValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $id = $validator->getValue('roleId');
        $routerId = $validator->getValue('routerId');

        $res = Role::getInstance()->updateRouter($id, $routerId);
        if ($res) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_ROLE_BIND_ROUTERS_FAIL);
    }

    public function reloadRoutersAction()
    {
        $res = Role::getInstance()->reloadRouters();
        if ($res) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_ROLE_RELOAD_ROUTERS_FAIL);
    }
}
