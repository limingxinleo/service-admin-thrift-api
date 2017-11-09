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
        return md5(md5($password) . app('admin')->passwordKey);
    }
}