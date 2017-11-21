<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/22
 * Time: 0:06
 */
class SeckillModel
{
    private $redisConn;
    public function __construct()
    {
        $this->redisConn = \Jeemu\Dispatcher::getInstance()->getRedis();
    }

    public function add($str){
        if ($this->redisConn->lLen('a') < 1000){
            $this->redisConn->lPush('a',$str);
        }else{
            $this->redisConn->lPush('b',$str);
        }
    }
}