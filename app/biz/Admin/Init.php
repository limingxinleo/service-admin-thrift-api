<?php
// +----------------------------------------------------------------------
// | Init.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Admin;

use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Models\User as UserModel;
use App\Biz\Base;

class Init extends Base
{
    /**
     * @desc   判断是否存在超级账户
     * @author limx
     */
    public function check()
    {
        $user = UserModel::findFirst([
            'conditions' => 'username = ?0',
            'bind' => ['superadmin'],
        ]);

        if (empty($user)) {
            // 用户不存在，则返回True
            return true;
        }
        return false;
    }

    public function create()
    {
        if (!$this->check()) {
            throw new BizException(ErrorCode::$ENUM_SUPER_ADMIN_EXIST);
        }

        $user = new UserModel();
        $user->username = 'superadmin';
        $user->password = password('superadmin');
        $user->nickname = '超级管理员';
        $user->email = '715557344@qq.com';
        return $user->save();
    }
}