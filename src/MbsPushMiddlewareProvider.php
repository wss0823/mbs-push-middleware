<?php
/**
 * Created by PhpStorm.
 * User: weng
 * Date: 4/23/21
 * Time: 4:15 PM
 */
namespace Uniondrug\MbsPushMiddleware;

use Phalcon\Di\ServiceProviderInterface;

class MbsPushMiddlewareProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->set(
            'mbsPushMiddlewareService',
            function () {
                return new MbsPushMiddewareService();
            }
        );
    }
}