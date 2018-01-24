<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Router;
use App\Common\Enums\ErrorCode;
use App\Common\Validator\Admin\RouterAddValidator;
use App\Common\Validator\Admin\RouterListValidator;
use App\Controllers\AuthController;
use App\Utils\Response;

class RouterController extends AuthController
{
    public function updateAction()
    {
        $routes = $this->router->getRoutes();
        $failed = [];
        foreach ($routes as $route) {
            $pattern = $route->getPattern();
            $name = $route->getName();
            if (!Router::getInstance()->updateSystemRouter($pattern, $name)) {
                $failed[] = ['route' => $pattern, 'name' => $name];
            }
        }

        return Response::success([
            'failed' => $failed
        ]);
    }

    public function listAction()
    {
        $data = $this->request->get();
        $validator = new RouterListValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');

        $items = Router::getInstance()->routes([
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize
        ]);
        $count = Router::getInstance()->count();
        $result = [];
        foreach ($items as $item) {
            $result[] = [
                'id' => $item->id,
                'name' => $item->name,
                'route' => $item->route,
                'type' => $item->type,
                'typeName' => Router::getInstance()->getTypeName($item->type),
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
        $validator = new RouterAddValidator();
        if ($validator->validate($data)->valid()) {
            return Response::fail(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $name = $validator->getValue('name');
        $route = $validator->getValue('route');

        $res = Router::getInstance()->save([
            'name' => $name,
            'route' => $route,
        ]);

        if ($res) {
            return Response::success();
        }

        return Response::fail(ErrorCode::$ENUM_ROUTER_ADD_FAIL);
    }
}
