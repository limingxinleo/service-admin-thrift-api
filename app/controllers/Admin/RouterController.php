<?php

namespace App\Controllers\Admin;

use App\Biz\Admin\Router;
use App\Controllers\Controller;
use App\Utils\Response;

class RouterController extends Controller
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
}
