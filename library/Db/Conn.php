<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:26
 */
class Db_Conn
{


    protected static $handle;



    public static function getInstance()
    {
        if (self::$handle == null) {
           new self();
        }
        return self::$handle;
    }


    private function __construct()
    {
        self::$handle = new \Medoo\Medoo(conf('db'));
        //$this->getTableName();
    }

}