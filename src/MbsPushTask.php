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
        $this->logger->info("推送的数据是:".json_encode($data));
        $data['message'] = json_decode($data['message'],true);
        $this->serviceSdk->module->jmbs->publish($data);
    }
}