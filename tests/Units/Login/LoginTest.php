<?php
// +----------------------------------------------------------------------
// | LoginTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Login;

use App\Biz\Auth\User;
use App\Common\Enums\ErrorCode;
use Tests\HttpTestCase;

/**
 * Class UnitTest
 */
class LoginTest extends HttpTestCase
{
    public function testLoginSuccess()
    {
        $data = [
            'username' => 'superadmin',
            'password' => 'superadmin'
        ];

        $content = $this->post('/api/user/login', $data);
        $json = json_decode($content->getContent(), true);
        $this->assertEquals(0, $json['code']);
        $this->assertEquals(User::getInstance()->token, $json['data']['token']);
    }
}