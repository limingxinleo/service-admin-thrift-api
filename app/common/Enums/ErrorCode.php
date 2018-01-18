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
    public static $ENUM_PARAMS_ERROR = 2000;
}
