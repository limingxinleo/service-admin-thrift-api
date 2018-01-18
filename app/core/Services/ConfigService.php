<?php
// +----------------------------------------------------------------------
// | Config 服务 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Core\Services;

use Phalcon\DI\FactoryDefault;
use Phalcon\Config;
use Xin\Phalcon\Config\Center\Client;

class ConfigService implements ServiceProviderInterface
{
    public function register(FactoryDefault $di, Config $config)
    {
        /**
         * Shared configuration service
         */
        $di->setShared('config', function () use ($config) {
            return $config;
        });

        // 载入配置中心
        $dir = $config->application->configDir . 'center/';

        Client::getInstance()->load($dir);
    }
}
