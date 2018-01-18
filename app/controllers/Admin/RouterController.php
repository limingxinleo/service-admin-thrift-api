<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class RouterController extends Controller
{
    public function updateAction()
    {
        $routes = $this->router->getRoutes();
        foreach ($routes as $route) {
            $pattern = $route->getPattern();
            $name = $route->getName();
            dump($name, $pattern);
        }
    }
}
