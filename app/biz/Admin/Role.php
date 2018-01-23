<?php
// +----------------------------------------------------------------------
// | Role.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Admin;

use App\Biz\Base;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Common\Enums\SystemCode;
use App\Models\Role as RoleModel;
use App\Models\RoleRouter;
use App\Models\Router as RouterModel;
use App\Utils\DB;

class Role extends Base
{
    /**
     * @desc
     * @author limx
     * @param $pageIndex
     * @param $pageSize
     * @return RoleModel[]
     */
    public function roles($pageIndex, $pageSize)
    {
        return RoleModel::find([
            'offset' => $pageSize * $pageIndex,
            'limit' => $pageSize
        ]);
    }

    /**
     * @desc   返回角色总数
     * @author limx
     * @return mixed
     */
    public function count()
    {
        return RoleModel::count();
    }

    /**
     * @desc
     * @author limx
     * @param $roleId
     * @return \App\Models\Router[]
     */
    public function routers($roleId)
    {
        $role = RoleModel::findFirst($roleId);
        return $role->routers;
    }

    /**
     * @desc   更新角色绑定的路由
     * @author limx
     * @param       $roleId
     * @param array $routerIds
     * @return bool
     */
    public function updateRouters($roleId, array $routerIds)
    {
        $role = RoleModel::findFirst($roleId);
        if (empty($role)) {
            throw new BizException(ErrorCode::$ENUM_ROLE_NOT_EXIST);
        }

        $routers = RouterModel::query()->inWhere('id', $routerIds)->execute();
        $existRouterIds = array_column($routers->toArray(), 'id');

        try {
            DB::begin();
            // 删除已有的关系
            $res = RoleRouter::deleteByRoleId($roleId);
            if (!$res) {
                throw new BizException(ErrorCode::$ENUM_ROLE_DELETE_ROUTERS_FAIL);
            }
            // 构建新的关系表
            foreach ($routerIds as $routerId) {
                if (in_array($routerId, $existRouterIds)) {
                    $rel = new RoleRouter();
                    $rel->role_id = $roleId;
                    $rel->router_id = $routerId;
                    if (!$rel->save()) {
                        throw new BizException(ErrorCode::$ENUM_ROLE_BIND_ROUTERS_FAIL);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }


        return true;
    }

    /**
     * @desc   更新角色
     * @author limx
     * @param array $data
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            $role = RoleModel::findFirst($data['id']);
        }

        if (empty($role)) {
            $role = new RoleModel();
        }

        $role->role_name = $data['roleName'];
        $role->role_desc = $data['roleDesc'];

        return $role->save();
    }
}
