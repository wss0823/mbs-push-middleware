<?php
/**
 * Created by PhpStorm.
 * User: weng
 * Date: 4/23/21
 * Time: 3:52 PM
 */
namespace Uniondrug\MbsPushMiddleware;

use Uniondrug\Framework\Container;
use Uniondrug\Framework\Services\Service;
use Uniondrug\Phar\Server\Services\Http;

class MbsPushMiddewareService extends Service
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getSwoole()
    {
        /**
         * @var Container $di
         */
        $di = $this->di;
        $swoole = $di->getShared('server');
        if ($swoole instanceof Http) {
            return $swoole;
        }
        throw new \Exception("only work with swoole mode");
    }
}