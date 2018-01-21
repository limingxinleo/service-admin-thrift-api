<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Router;
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
            if (!Router::getInstance()->update($pattern, $name)) {
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

        $items = Router::getInstance()->routes($pageIndex, $pageSize);
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
            'items' => $result
        ]);
    }

    public function saveAction()
    {

    }
}
