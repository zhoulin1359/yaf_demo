<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/28
 * Time: 19:07
 */
class RedisUserModel
{
    /**
     * @var Singleton
     */
    private static $instance;

    private static $handle;

    private $redisName = 'user';

    private $expire = 86400 * 10;
    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }
        return static::$instance;
    }



    public  function setHash($key,$field,$value,$timeout=0){
        return self::$handle->hset($key,$field,$value);
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {

        $redisConf = config('redis.'.SERVER_TYPE.'.'.$this->redisName);
        if (empty($redisConf)){
            ajaxReturn(null,'服务器出现问题_1320',-1);
        }
        static::$handle = new Redis();
        // self::$handle = new Redis();
        self::$handle ->connect($redisConf['host'],$redisConf['port']);
        if (isset($redisConf['select'])){
            self::$handle ->select($redisConf['select']);
        }
        if (isset($redisConf['auth'])){
            self::$handle ->auth($redisConf['select']);
        }

    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }
}