<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/30
 * Time: 17:38
 */
class RedisModel extends Db_RedisBase
{
    public function setKey($redisKey)
    {

        $count = $this->handle->get($redisKey);
        if ($count) {
            $check = $this->handle->setnx('test'.$count,1);
            if ($check)
            $this->handle->set($redisKey, ++$count, 34500);
        } else {
            $this->handle->set($redisKey, 1, 2333);
            }

    }


    public function setKeyByLock($redisKey)
    {
        $count = $this->handle->get($redisKey);
        if ($count) {
            $this->handle->watch($redisKey);
            $this->handle->multi();
            $this->handle->set($redisKey, ++$count, 34500);
            $this->handle->exec();
        }else{
            $this->handle->set($redisKey, 1, 2333);
        }
    }


    public function setKeyIncr(){
        $this->handle->Incr(2);
    }

}