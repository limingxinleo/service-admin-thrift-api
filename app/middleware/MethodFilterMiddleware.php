<?php
// +----------------------------------------------------------------------
// | AuthMiddleware.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Middleware;

use App\Utils\Log;
use App\Utils\Response;
use Closure;
use Xin\Phalcon\Middleware\Middleware;

class MethodFilterMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        if (!$this->request->isOptions()) {
            return $next($request);
        }

        return Response::success([
            'reason' => 'The Options Method is Forbidden'
        ]);
    }
}
