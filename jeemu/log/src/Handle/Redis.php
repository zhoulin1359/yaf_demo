<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 11:52
 */

namespace Jeemu\Log\Handle;


use Jeemu\Dispatcher;

class Redis extends AbstractHandler
{

    private $redisListKey;

    private $timeOut = 86400 * 30;

    public function __construct(string $path, int $timeOut = 0)
    {
        $this->driverHandle = Dispatcher::getInstance()->getRedis('redis_log');
        $this->driverHandle->select(3);
        if ($timeOut) {
            $this->timeOut = $timeOut;
        }
        $this->redisListKey = $path;

    }

    public function saveLog(string $content): bool
    {
        $this->driverHandle->lPush($this->redisListKey, $content);
        $this->driverHandle->expire($this->redisListKey, $this->timeOut);
        return true;
        // TODO: Implement saveLog() method.
    }
}