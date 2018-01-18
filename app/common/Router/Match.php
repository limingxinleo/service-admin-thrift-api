<?php
// +----------------------------------------------------------------------
// | Match.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Router;

use Xin\Traits\Common\InstanceTrait;

class Match
{
    use InstanceTrait;

    /**
     * @desc   匹配路由是否属于某规则
     * @author limx
     * @param $router  路由
     * @param $regular 规则
     */
    public function isMatchRouter($router, $regular)
    {
        $regular = str_replace('*', '.*', $regular);
        $regular = str_replace('/', '\\/', $regular);
        return preg_match("/^{$regular}$/", $router) === 1;
    }
}
