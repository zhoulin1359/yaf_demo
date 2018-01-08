<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2018/1/4
 * Time: 11:38
 */

namespace Jeemu\Db\Connect;


class Redis
{
    protected $redisKey;
    public $handle;
    protected $ttl = -1;

    public function __construct(string $conf = 'redis')
    {
        $this->handle = \Jeemu\Dispatcher::getInstance()->getRedis($conf);
    }


    protected function setExpire(string $redisKey): bool
    {
        if ($this->ttl !== -1) {
            return ($this->handle->expire($redisKey, $this->ttl)) ? true : false;
        }
        return true;
    }

    public function getError()
    {
        return $this->handle->getLastError();
    }
}