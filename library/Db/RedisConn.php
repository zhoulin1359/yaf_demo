<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/30
 * Time: 17:24
 */
class Db_RedisConn extends Db_Conn
{

    protected function getConn()
    {
        return conf('redis');
        // TODO: Implement getConn() method.
    }

    protected function init($conf)
    {
        $obj = new \Redis();
        $obj->connect($conf['host'], isset($conf['port']) ? $conf['port'] : 6379);
        if (!empty($conf['auth'])) {
            $obj->auth($conf['auth']);
        }
        if (!empty($conf['select'])) {
            $obj->select($conf['select']);
        }
        return $obj;
    }
}