<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:26
 */
class Db_Conn
{


    private static $handle;
    private static $db;


    public static function getInstance($db)
    {
        $dbConf = conf($db);
        if ($dbConf){
            die('db conf error!');
        }
        self::$db = $db;
        if (isset(self::$handle[$db])){
            return self::$handle[$db];
        }else{
            new self($dbConf);
            return self::$handle[$db];
        }
    }


    private function __construct($dbConf)
    {
        self::$handle[self::$db] = new \Medoo\Medoo($dbConf);
        //$this->getTableName();
    }

}