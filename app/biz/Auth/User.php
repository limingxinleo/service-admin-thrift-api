<?php
// +----------------------------------------------------------------------
// | User.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Auth;

use App\Biz\Base;
use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Models\User as UserModel;
use App\Utils\Redis;
use Phalcon\Text;

class User extends Base
{
    public $user;

    public $token;

    public function login($usernmae, $password)
    {
        $user = UserModel::findFirst([
            'conditions' => 'username = ?0',
            'bind' => [$usernmae]
        ]);
        if (empty($user)) {
            return false;
        }

        if ($user->password !== password($password)) {
            return false;
        }

        $this->user = $user;
        $this->token = Text::random(16);

        $this->setUserCache();

    }

    protected function setUserCache()
    {
        if (empty($this->token) || empty($this->user)) {
            throw new BizException('授权信息保存失败', ErrorCode::$ENUM_SYSTEM_ERROR);
        }

        return Redis::set($this->token, serialize($this->user), 3600);
    }

    /**
     * @desc
     * @author limx
     * @param $token
     * @return mixed
     */
    public function getUserCache($token)
    {
        $res = Redis::get($token);
        if ($res && $user = unserialize($res)) {
            if ($user instanceof UserModel) {
                Redis::expire($token, 3600);
                return $user;
            }
        }

        throw new BizException('TOKEN已超时', ErrorCode::$ENUM_TOKEN_TIMEOUT);
    }

}