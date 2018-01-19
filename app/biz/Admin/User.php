<?php
// +----------------------------------------------------------------------
// | User.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Admin;

use App\Biz\Base;
use App\Common\Enums\SystemCode;
use App\Models\User as UserModel;

class User extends Base
{
    /**
     * @desc
     * @author limx
     * @param $pageIndex
     * @param $pageSize
     * @return UserModel[]
     */
    public function userList($pageIndex, $pageSize)
    {
        return UserModel::find([
            'limit' => $pageSize,
            'offset' => $pageIndex * $pageSize
        ]);
    }

    /**
     * @desc   获取管理员类型
     * @author limx
     * @param $type
     * @return string
     */
    public function getTypeName($type)
    {
        if ($type === SystemCode::ADMIN_USER_SUPER_TYPE) {
            return 'Super';
        } else if ($type === SystemCode::ADMIN_USER_NORMAL_TYPE) {
            return 'Normal';
        }
        return '未知';
    }
}
