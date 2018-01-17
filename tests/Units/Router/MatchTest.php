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
    public function testBaseCase()
    {
        $router = '/';
        $regular = '/*';

        $this->assertTrue(Match::getInstance()->isMatchRouter($router, $regular));
    }
}