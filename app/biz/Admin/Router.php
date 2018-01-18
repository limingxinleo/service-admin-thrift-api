<?php
// +----------------------------------------------------------------------
// | Router.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Admin;

use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Common\Enums\SystemCode;
use Xin\Traits\Common\InstanceTrait;
use App\Models\Router as RouterModel;
use App\Models\User as UserModel;

class Router
{
    use InstanceTrait;

    /**
     * @desc   更新路由
     * @author limx
     * @param $route
     * @param $name
     */
    public function update($route, $name = null)
    {
        if (empty($name)) {
            throw new BizException(
                ErrorCode::$ENUM_ROUTER_NAME_IS_NOT_DEFINED,
                $route . '路由名字未定义'
            );
        }

        $router = RouterModel::findFirst([
            'conditions' => 'route = ?0',
            'bind' => [$route]
        ]);

        if (empty($router)) {
            $router = new RouterModel();
            $router->route = $route;
            $router->name = $name;
            return $router->save();
        }

        if ($router->name !== $name) {
            $router->name = $name;
            return $router->save();
        }

        return true;
    }

    /**
     * @desc   用户是否有当前路由的访问权限
     * @author limx
     */
    public function isMatch($id, $route)
    {
        $user = UserModel::findFirst($id);
        if ($user->type === SystemCode::ADMIN_USER_SUPER_TYPE) {
            return true;
        }

        return false;
    }
}