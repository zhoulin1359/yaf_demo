<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:26
 */
abstract class Db_Conn
{


    protected static $handle;

    public static function getInstance()
    {
        if (empty(self::$handle)) {
            new static();
        }
        return self::$handle;
    }

    protected function __construct()
    {
        self::$handle = static::init(static::getConn());
    }

    abstract protected function init($conf);

    abstract  protected function getConn();

}