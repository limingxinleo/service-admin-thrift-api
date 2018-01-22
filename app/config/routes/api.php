<?php
// +----------------------------------------------------------------------
// | api.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
use Phalcon\Mvc\Router\Group as RouterGroup;

// Create a group with a common module and controller
$router->group(function () {
    $api = new RouterGroup();

    // All the routes start with /api
    $api->setPrefix('/api');

    $api->add('/user/login', 'App\\Controllers\\Admin\\Login::login')->setName('管理员登录');
    $api->add('/user/logout', 'App\\Controllers\\Admin\\User::logout')->setName('管理员登出');
    $api->add('/user/info', 'App\\Controllers\\Admin\\User::info')->setName('管理员基本信息');
    $api->add('/user/list', 'App\\Controllers\\Admin\\User::list')->setName('管理员列表');
    $api->add('/user/save', 'App\\Controllers\\Admin\\User::save')->setName('保存管理员');

    $api->add('/router/update', 'App\\Controllers\\Admin\\Router::update')->setName('路由更新');
    $api->add('/router/list', 'App\\Controllers\\Admin\\Router::list')->setName('路由列表');
    $api->add('/router/save', 'App\\Controllers\\Admin\\Router::save')->setName('新增路由');

    $api->add('/role/list', 'App\\Controllers\\Admin\\Role::list')->setName('角色列表');
    $api->add('/role/save', 'App\\Controllers\\Admin\\Role::save')->setName('新增角色');

    return $api;
});
