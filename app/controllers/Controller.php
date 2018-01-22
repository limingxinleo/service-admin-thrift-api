<?php
// +----------------------------------------------------------------------
// | 控制器基类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Controllers;

use App\Biz\BizException;
use App\Common\Enums\ErrorCode;
use App\Utils\Response;
use Xin\Phalcon\Logger\Factory;

abstract class Controller extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->middleware->set([
            'method.filter'
        ]);
    }

    public function beforeExecuteRoute()
    {
        // 在每一个找到的动作前执行
        $request = $this->request->get();
        /** @var Factory $factory */
        $factory = di('logger');
        $logger = $factory->getLogger('request');
        $message = PHP_EOL;
        $message .= '接口:' . $this->request->getURI() . PHP_EOL;
        $message .= '方法:' . $this->request->getMethod() . PHP_EOL;
        $message .= '参数:' . json_encode($request, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        $logger->info($message);
    }

    public function afterExecuteRoute()
    {
        // 在每一个找到的动作后执行
    }
}
