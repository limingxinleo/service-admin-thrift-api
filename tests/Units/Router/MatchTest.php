<?php
// +----------------------------------------------------------------------
// | MatchTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Router;

use App\Common\Router\Match;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class MatchTest extends UnitTestCase
{
    public function testAllRouterCase()
    {
        $regular = '/*';
        $routers = [
            '/',
            '/index/index',
            '/test/index',
        ];
        foreach ($routers as $router) {
            $this->assertTrue(Match::getInstance()->isMatchRouter($router, $regular));
        }
    }

    public function testApiRouterCase()
    {
        $regular = '/api/*';
        $routers = [
            '/api/test',
            '/api/index',
        ];
        foreach ($routers as $router) {
            $this->assertTrue(Match::getInstance()->isMatchRouter($router, $regular));
        }

        $routers = [
            '/',
            '/apii/index',
        ];
        foreach ($routers as $router) {
            $this->assertFalse(Match::getInstance()->isMatchRouter($router, $regular));
        }
    }

    public function testRouterCase()
    {
        $regular = '/api/index';
        $this->assertTrue(Match::getInstance()->isMatchRouter($regular, $regular));

        $this->assertFalse(Match::getInstance()->isMatchRouter('/', $regular));
        $this->assertFalse(Match::getInstance()->isMatchRouter('/api/index2', $regular));

    }
}