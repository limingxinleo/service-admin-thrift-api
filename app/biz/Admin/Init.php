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
use App\Common\Enums\SystemCode;
use App\Models\User as UserModel;
use App\Biz\Base;

class Init extends Base
{
    public function init()
    {
        $super = UserModel::findFirst([
            'conditions' => 'username = ?0',
            'bind' => ['superadmin'],
        ]);

        $super->password = password('superadmin');
        $super->save();

        $user = UserModel::findFirst([
            'conditions' => 'username = ?0',
            'bind' => ['test'],
        ]);
        $user->password = password('test');
        $user->save();
    }
}
