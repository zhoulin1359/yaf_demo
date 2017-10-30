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
    public function __construct($conf = 'redis')
    {
        $this->handle = Db_RedisConn::getInstance($conf);
    }

}