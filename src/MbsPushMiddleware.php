<?php
/**
 * Created by PhpStorm.
 * User: weng
 * Date: 4/23/21
 * Time: 3:38 PM
 */
namespace Uniondrug\MbsPushMiddleware;

use Phalcon\Http\RequestInterface;
use Uniondrug\Middleware\DelegateInterface;
use Uniondrug\Middleware\Middleware;
use Uniondrug\Phar\Server\Tables\XTable;

/**
 * Class MbsPushMiddleware
 * @package Uniondrug\MbsPushMiddleware
 * @property MbsPushMiddewareService $mbsPushMiddlewareService
 */
class MbsPushMiddleware extends Middleware
{
    public $swoole = null;
    public $table = "";
    public $requestId = "";

    /**
     * MbsPushMiddleware constructor.
     * @throws \Exception
     */
    function __construct()
    {
        $this->swoole = $this->mbsPushMiddlewareService->getSwoole();
        $this->table = $this->getTable($this->config->path("middleware.mbsPush.table"));
        $this->requestId = $this->getRequestId();
    }

    private function getRequestId()
    {
        return $this->swoole->getTrace()->getRequestId();
    }

    //拉去内存表

    /**
     * @param string $tableName
     * @return XTable
     */
    private function getTable(string $tableName)
    {
        return $this->swoole->getTable($tableName);
    }

    /**
     * @param RequestInterface  $request
     * @param DelegateInterface $next
     * @return \Phalcon\Http\ResponseInterface|void
     */
    public function handle(RequestInterface $request, DelegateInterface $next)
    {
        $return = $next($request);
        //判断table是否包含本请求链
        /**
         * @var XTable $table
         */
        $table = $this->table;
        if ($table->exist($this->requestId)) {
            //存在进行消息推送
            $this->addMbs();
        }
        return $return;
    }

    private function addMbs()
    {
        $mbsArr = $this->table->get($this->requestId);
        $this->table->del($this->requestId);
        $this->swoole->runTask(MbsPushTask::class,$mbsArr);
    }
}