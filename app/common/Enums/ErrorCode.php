<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{

    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('通用错误')
     */
    public static $ENUM_COMMON_ERROR = 401;

    /**
     * @Message('TOKEN必填')
     */
    public static $ENUM_TOKEN_REQUIRED = 700;

    /**
     * @Message('TOKEN无效或已超时')
     */
    public static $ENUM_TOKEN_TIMEOUT = 701;

    /**
     * @Message('账号不存在或者密码错误')
     */
    public static $ENUM_PASSWORD_INVALID = 702;

    /**
     * @Message('账号登出失败')
     */
    public static $ENUM_LOGOUT_FAIL = 703;

    /**
     * @Message('非法访问')
     */
    public static $ENUM_ILLEGAL_REQUEST = 704;

    /**
     * @Message('超级管理员已存在')
     */
    public static $ENUM_SUPER_ADMIN_EXIST = 1000;

    /**
     * @Message('超级管理员不允许删除')
     */
    public static $ENUM_SUPER_ADMIN_SHOULD_NOT_DELETE = 1001;

    /**
     * @Message('路由名字没有定义')
     */
    public static $ENUM_ROUTER_NAME_IS_NOT_DEFINED = 1010;

    /**
     * @Message('入参不符')
     */
    public static $ENUM_PARAMS_ERROR = 1100;

    /**
     * @Message('保存管理员信息失败')
     */
    public static $ENUM_ADMIN_ADD_FAIL = 2000;

    /**
     * @Message('管理员登录名重复')
     */
    public static $ENUM_ADMIN_USERNAME_EXIST = 2001;

    /**
     * @Message('管理员不存在')
     */
    public static $ENUM_ADMIN_NOT_EXIST = 2002;

    /**
     * @Message('管理员绑定角色失败')
     */
    public static $ENUM_ADMIN_BIND_ROLE_FAIL = 2003;

    /**
     * @Message('路由保存失败')
     */
    public static $ENUM_ROUTER_ADD_FAIL = 2100;

    /**
     * @Message('系统路由不允许修改')
     */
    public static $ENUM_SYSTEM_ROUTER_CAN_NOT_CHANGED = 2101;

    /**
     * @Message('路由不存在')
     */
    public static $ENUM_ROUTER_NOT_EXIST = 2102;

    /**
     * @Message('角色保存失败')
     */
    public static $ENUM_ROLE_ADD_FAIL = 2200;

    /**
     * @Message('角色不存在')
     */
    public static $ENUM_ROLE_NOT_EXIST = 2201;

    /**
     * @Message('角色绑定路由失败')
     */
    public static $ENUM_ROLE_BIND_ROUTERS_FAIL = 2202;

    /**
     * @Message('删除角色路由失败')
     */
    public static $ENUM_ROLE_DELETE_ROUTERS_FAIL = 2203;

    /**
     * @Message('刷新角色权限失败')
     */
    public static $ENUM_ROLE_RELOAD_ROUTERS_FAIL = 2204;
}
