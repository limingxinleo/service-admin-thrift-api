<?php
// +----------------------------------------------------------------------
// | Response.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Utils;

use App\Common\Enums\ErrorCode;

class Response
{
    public static function success($data)
    {
        /** @var \Phalcon\Http\Response $response */
        $response = di('response');
        return $response->setJsonContent([
            'code' => 0,
            'data' => $data
        ]);
    }

    public static function fail($code, $message = null)
    {
        /** @var \Phalcon\Http\Response $response */
        $response = di('response');
        if (!isset($message)) {
            $message = ErrorCode::getMessage($code);
        }

        return $response->setJsonContent([
            'code' => $code,
            'message' => $message
        ]);
    }
}