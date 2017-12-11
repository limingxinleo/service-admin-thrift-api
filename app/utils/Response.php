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
    private static function response(array $data)
    {
        /** @var \Phalcon\Http\Response $response */
        $response = di('response');
        return $response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setJsonContent($data);
    }

    public static function success($data)
    {
        return static::response([
            'code' => 0,
            'data' => $data
        ]);
    }

    public static function fail($code, $message = null)
    {
        // 避免出现第三方插件有错误码为0的情况
        if ($code === 0) $code = ErrorCode::$ENUM_SYSTEM_ERROR;
        if (empty($message)) {
            $message = ErrorCode::getMessage($code);
        }

        return static::response([
            'code' => $code,
            'message' => $message
        ]);
    }
}