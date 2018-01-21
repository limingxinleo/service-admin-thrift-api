<?php
// +----------------------------------------------------------------------
// | common.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

if (!function_exists('password')) {
    /**
     * @desc   对密码进行加密
     * @author limx
     * @param $password
     * @return string
     */
    function password($password)
    {
        return md5(md5($password) . config('base')->passwordKey);
    }
}

if (!function_exists('config')) {
    /**
     * @desc   获取自定义配置
     * @author limx
     * @param $key
     * @return string
     */
    function config($key)
    {
        return \Xin\Phalcon\Config\Center\Client::getInstance()->get($key);
    }
}

if (!function_exists('get_default_avatar')) {

    /**
     * @desc   获取默认头像
     * @author limx
     */
    function get_default_avatar()
    {
        return di('config')->domain . '/static/images/logo.png';
    }
}
