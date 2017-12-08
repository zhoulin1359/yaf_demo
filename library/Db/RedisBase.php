<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/30
 * Time: 17:34
 */
class Db_RedisBase
{
    protected $timeOut = 3600;
    protected $redisKey;
    public $handle;
    protected $ttl = -1;

    public function __construct()
    {
        $this->handle = Jeemu\Dispatcher::getInstance()->getRedis();
    }


    protected function setExpire(string $redisKey):bool
    {
        if ($this->ttl !== -1){
            return ($this->handle->expire($redisKey,$this->ttl))?true:false;
        }
        return true;
    }

    public function getError(){
        return $this->handle->getLastError();
    }



}