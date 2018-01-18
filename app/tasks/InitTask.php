<?php

namespace App\Tasks;

use App\Biz\Admin\Init;
use Xin\Cli\Color;

class InitTask extends Task
{
    public function mainAction()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  项目初始化') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  php run init@[action]', Color::FG_LIGHT_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Actions:') . PHP_EOL;
        echo Color::colorize('  admin    新建Admin账号和权限', Color::FG_LIGHT_GREEN) . PHP_EOL;
    }

    public function adminAction()
    {
        try {
            Init::getInstance()->init();
            echo Color::success('管理员数据重置成功');
        } catch (\Exception $ex) {
            echo Color::error($ex->getMessage());
        }
    }
}
