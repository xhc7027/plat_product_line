<?php

namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\index\logic\ConnectMQTT;

/**
 * 获取专业检测记录数据脚本
 *
 * Class getOMSDetectRecord
 * @package app\common\command
 */
class deleteDeviceName extends Command
{
    protected function configure()
    {
        $this->setName('deleteDeviceName')->setDescription('Delete DeviceName EveryDay');
    }

    protected function execute(Input $input, Output $output)
    {
        $logic = new ConnectMQTT();
        $result = $logic->deleteDeviceName();
        return $result;
    }
}
