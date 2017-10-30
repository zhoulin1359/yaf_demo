<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/30
 * Time: 19:52
 */
class RedisCacheModel extends Db_RedisBase
{
    protected $redisKey;
    protected $cacheValue;
    private $errorMsg;

    public function setCache($redisKey, $value, $timeOut = 0)
    {
        $this->redisKey = $redisKey;
        $this->cacheValue = $value;
        if (!empty($timeOut)) {
            $this->timeOut = $timeOut;
        }
        if (!$this->checkKey()) {
            $this->errorMsg = 'redis key error!';
            return false;
        }
        if ($this->handle->exists($this->redisKey)) {
            return true;
        }
        $this->setOption();
        $this->handle->incr(2);
        return $this->handle->set($this->redisKey, $this->cacheValue, $this->timeOut);
    }


    public function getCache($redisKey){
        $this->redisKey = $redisKey;
        if (!$this->checkKey()) {
            $this->errorMsg = 'redis key error!';
            return false;
        }
        $this->setOption();
        return $this->handle->get($this->redisKey);
    }

    /**
     * 设置系列化
     */
    private function setOption()
    {
        $this->handle->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    }

    /**
     * 判断键-必须为字符串
     * @param $redisKey
     * @return bool
     */
    private function checkKey()
    {
        if (is_string($this->redisKey)) {
            return true;
        }
        return false;
    }

    public function getErrorMsg(){
        return $this->errorMsg;
    }

}