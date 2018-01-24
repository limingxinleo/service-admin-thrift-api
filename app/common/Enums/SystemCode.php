<?php
// +----------------------------------------------------------------------
// | SystemCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

class SystemCode
{
    // 管理员权限
    const ADMIN_USER_SUPER_TYPE = 1; // 超级管理员
    const ADMIN_USER_NORMAL_TYPE = 0; // 普通管理员

    // 路由类型
    const ADMIN_ROUTER_SYSTEM_TYPE = 1; // 系统类型
    const ADMIN_ROUTER_NORMAL_TYPE = 0; // 自定义类型

    const ADMIN_ROUTER_SEARCH_TYPE_ALL = 0; // 所有路由
    const ADMIN_ROUTER_SEARCH_TYPE_BOUND = 1; // 已绑定的路由

    // 模型缓存
    const REDIS_KEY_MODEL_CACHE_KEY = 'cache:model:%s:conditions:%s';

    // 角色路由缓存
    const REDIS_KEY_ROLE_ROUTER_CACHE_KEY = 'cache:role:%s:routers';
}
