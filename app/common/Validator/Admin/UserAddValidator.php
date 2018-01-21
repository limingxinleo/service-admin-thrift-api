<?php
// +----------------------------------------------------------------------
// | UserAddValidator.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Validator\Admin;

use App\Core\Validation\Validator;
use Phalcon\Validation\Validator\PresenceOf;

class UserAddValidator extends Validator
{
    public function initialize()
    {
        $this->add(
            [
                'nickname',
                'username',
                'email',
                'mobile',
            ],
            new PresenceOf([
                'message' => 'The :field is required',
            ])
        );
    }
}
