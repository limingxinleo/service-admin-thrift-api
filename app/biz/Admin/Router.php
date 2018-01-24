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
use App\Core\System;
use App\Models\RoleRouter;
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
    public function updateSystemRouter($route, $name = null)
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
            $router->type = SystemCode::ADMIN_ROUTER_SYSTEM_TYPE;
            return $router->save();
        }

        if ($router->name !== $name || $router->type !== SystemCode::ADMIN_ROUTER_SYSTEM_TYPE) {
            $router->name = $name;
            $router->type = SystemCode::ADMIN_ROUTER_SYSTEM_TYPE;
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

    /**
     * @desc
     * @author limx
     * @param $pageIndex
     * @param $pageSize
     * @return RouterModel[]
     */
    public function routes(array $data)
    {
        $pageIndex = $data['pageIndex'];
        $pageSize = $data['pageSize'];
        $query = RouterModel::query();
        if (!empty($data['searchText']) && $searchText = $data['searchText']) {
            $query = $query->where('name like :name:', ['name' => $searchText . "%"]);
            $query = $query->orWhere('route like :route:', ['route' => $searchText . "%"]);
        }

        return $query->limit($pageSize, $pageSize * $pageIndex)->execute();
    }

    /**
     * @desc   获取某角色下的路由 带分页
     * @author limx
     * @param       $roleId
     * @param array $condition
     * @return array
     */
    public function routesByRoleId($roleId, array $condition = [])
    {
        $params = [];
        $params['conditions'] = 'role_id = :roleId:';
        $params['bind']['roleId'] = $roleId;

        $count = RoleRouter::count($params);

        if ($count === 0) {
            return [null, $count];
        }

        if (isset($condition['pageSize']) && $pageSize = $condition['pageSize']) {
            $params['limit'] = $pageSize;
            if (isset($condition['pageIndex']) && $pageIndex = $condition['pageIndex']) {
                $params['offset'] = $pageSize * $pageSize;
            }
        }

        $rel = RoleRouter::find($params);
        if (empty($rel)) {
            return [null, $count];
        }

        $routerIds = array_column($rel->toArray(), 'router_id');

        $result = RouterModel::query()->inWhere('id', $routerIds)->execute();
        return [$result, $count];
    }

    /**
     * @desc   获取所有路由
     * @author limx
     * @cache('3600')
     * @return RouterModel[]
     */
    public function all()
    {
        return RouterModel::find([
            'cache' => [
                'key' => sprintf(SystemCode::REDIS_KEY_MODEL_CACHE_KEY, 'router', 'all'),
                'lifetime' => 3600,
            ],
        ]);
    }

    /**
     * @desc   返回路由个数
     * @author limx
     * @return mixed
     */
    public function count(array $data = [])
    {
        $param = [
            'conditions' => ' 1=1 '
        ];

        if (!empty($data['searchText']) && $searchText = $data['searchText']) {
            $param['conditions'] .= ' AND (name like :name: OR route like :route:)';
            $param['bind'] = ['name' => $searchText . "%", 'route' => $searchText . "%"];
        }

        return RouterModel::count($param);
    }

    /**
     * @desc   保存路由
     * @author limx
     * @param array $data
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            $router = RouterModel::findFirst($data['id']);
            if ($router->type === SystemCode::ADMIN_ROUTER_SYSTEM_TYPE) {
                throw new BizException(ErrorCode::$ENUM_SYSTEM_ROUTER_CAN_NOT_CHANGED);
            }
        }

        if (empty($router)) {
            $router = new RouterModel();
        }

        $router->name = $data['name'];
        $router->route = $data['route'];

        return $router->save();
    }

    /**
     * @desc   获取管理员类型
     * @author limx
     * @param $type
     * @return string
     */
    public function getTypeName($type)
    {
        if ($type === SystemCode::ADMIN_ROUTER_SYSTEM_TYPE) {
            return '系统路由';
        } elseif ($type === SystemCode::ADMIN_ROUTER_NORMAL_TYPE) {
            return '自定义路由';
        }
        return '未知';
    }
}
