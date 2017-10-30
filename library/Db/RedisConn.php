<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/30
 * Time: 17:24
 */
class Db_RedisConn
{
    private static $handle;
    private static $db;

    public static function getInstance($conf)
    {
        $redisConf = conf($conf);
        if (empty($redisConf)) {
            die('redis conf error!');
        }
        self::$db = $conf;
        if (isset(self::$handle[self::$db])) {
            return self::$handle[self::$db];
        } else {
            new self($redisConf);
            return self::$handle[self::$db];
        }
    }


    private function __construct($redisConf)
    {
        if (empty($redisConf['host'])) {
            die('redis conf error!');
        }
        $tempConn = new \Redis();
        $tempConn->connect($redisConf['host'], isset($redisConf['port']) ? $redisConf['port'] : 6379);
        if (!empty($redisConf['auth'])) {
            $tempConn->auth($redisConf['auth']);
        }
        if (!empty($redisConf['select'])) {
            $tempConn->select($redisConf['select']);
        }
        self::$handle[self::$db] = $tempConn;
        //$this->getTableName();
    }

}