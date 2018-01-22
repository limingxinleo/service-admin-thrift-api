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
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
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
     * @desc   保存管理员
     * @author limx
     * @param array $data
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            $user = UserModel::findFirst($data['id']);
        }
        if (empty($user)) {
            if ($this->checkUserNameExist($data['username'])) {
                // 用户已存在
                throw new BizException(ErrorCode::$ENUM_ADMIN_USERNAME_EXIST);
            }
            
            $user = new UserModel();
        }
        $user->nickname = $data['nickname'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];
        $user->avatar = get_default_avatar();
        $user->password = password('910123');

        return $user->save();
    }

    /**
     * @desc   判断用户名是否存在
     * @author limx
     * @param $username
     * @return bool
     */
    public function checkUserNameExist($username)
    {
        $user = UserModel::findFirst([
            'conditions' => 'username = ?0',
            'bind' => [$username],
        ]);

        if ($user) {
            return true;
        }
        return false;
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
        } elseif ($type === SystemCode::ADMIN_USER_NORMAL_TYPE) {
            return 'Normal';
        }
        return '未知';
    }
}
