<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/12
 * Time: 22:18
 */
class DbConnModel
{
    /**
     * @var Singleton
     */
    private static $instance;

    private static $handle;

    private static $connNum = 3;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance($dbConf)
    {
        if (null === static::$instance) {
            new self($dbConf);
        }
        return static::$handle[rand(1, self::$connNum)];
    }


    private function __construct($dbConf)
    {
        $dbConf = config('mysql.'.$dbConf);
        if (empty($dbConf)){
           ajaxReturn(null,'服务器出现问题_1324',-1);
        }
        for ($i = 1; $i <= self::$connNum; $i++) {
            self::$handle[$i] = new \Medoo\Medoo(
                [
                    'database_type' => 'mysql',
                    'database_name' => isset($dbConf['database'])?$dbConf['database']:'',
                    'server' => isset($dbConf['host'])?$dbConf['host']:'',
                    'username' => isset($dbConf['user'])?$dbConf['user']:'',
                    'password' => isset($dbConf['password'])?$dbConf['password']:'',

                    // [optional]
                    'charset' => 'utf8',
                    'port' => isset($dbConf['port'])?$dbConf['port']:3306,

                    // [optional] Table prefix
                    'prefix' => isset($dbConf['prefix'])?$dbConf['prefix']:'',
                ]
            );
        }

    }

}