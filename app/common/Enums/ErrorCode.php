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
     * @Message('无效的TOKEN')
     */
    public static $ENUM_TOKEN_INVALID = 700;

    /**
     * @Message('TOKEN已超时')
     */
    public static $ENUM_TOKEN_TIMEOUT = 701;

    /**
     * @Message('超级管理员已存在')
     */
    public static $ENUM_SUPER_ADMIN_EXIST = 1000;

    /**
     * @Message('超级管理员不允许删除')
     */
    public static $ENUM_SUPER_ADMIN_SHOULD_NOT_DELETE = 1001;
}
