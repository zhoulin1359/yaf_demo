<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/24
 * Time: 16:30
 * Email: zhoulin@mapgoo.net
 */
class RedisConnModel
{
    /**
     * @var Singleton
     */
    private static $instance;

    private static $handle;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new Redis();
            // self::$handle = new Redis();
            self::$instance ->connect('127.0.0.1',6379);
            self::$instance ->select(3);
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
        static::$handle = new Redis();
        // self::$handle = new Redis();
        self::$handle ->connect('127.0.0.1',6379);
        self::$handle ->select(3);
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