<?php
/**
 * Created by PhpStorm.
 * User: weng
 * Date: 4/23/21
 * Time: 5:49 PM
 */
namespace Uniondrug\MbsPushMiddleware;

use Uniondrug\Phar\Server\Tasks\XTask;

/**
 * Class MbsPushTask
 * @package Uniondrug\MbsPushMiddleware
 * @property \Uniondrug\ServiceSdk\ServiceSdk $serviceSdk
 */
class MbsPushTask extends XTask
{
    public function run()
    {
        $data = $this->data;
        //异步写入数据
        $this->serviceSdk->module->jmbs->publish($data);
    }
}