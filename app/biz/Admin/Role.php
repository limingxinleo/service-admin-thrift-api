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
use App\Models\Role as RoleModel;

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
