<?php
// +----------------------------------------------------------------------
// | admin.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

// 管理员登录
$router->add('/user/login', 'App\\Controllers\\Admin\\Login::login');

// 管理员基本信息
$router->add('/user/info', 'App\\Controllers\\Admin\\User::info');