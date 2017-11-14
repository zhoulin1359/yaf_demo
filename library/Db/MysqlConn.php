<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/7
 * Time: 17:52
 */
class Db_MysqlConn extends Db_Conn
{


    protected function getConn()
    {
        return conf('db');
        // TODO: Implement getConn() method.
    }

    protected function init($conf)
    {
        return (new \Medoo\Medoo($conf));
        // TODO: Implement init() method.
    }
}