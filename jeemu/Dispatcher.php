<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/15
 * Time: 23:03
 */

namespace Jeemu;


use Medoo\Medoo;

class Dispatcher
{
    private static $handle;
    private static $obj;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$handle)) {
            self::$handle = new self();
        }
        return self::$handle;
    }

    public function getMysql(string $mysqlConf = 'db'): Medoo
    {
        if (empty(self::$obj[__FUNCTION__][$mysqlConf])) {
            self::$obj[__FUNCTION__][$mysqlConf] = (new Db\Mysql(conf($mysqlConf)))->getObj();
        }
        return self::$obj[__FUNCTION__][$mysqlConf];
    }


    public function getRedis(): \Redis
    {
        if (empty(self::$obj[__FUNCTION__])) {
            self::$obj[__FUNCTION__] = (new Db\Redis())->getObj();
        }
        return self::$obj[__FUNCTION__];
    }


    public function getLog(string $driver = 'redis', string $path = './runtime', string $type = 'date', int $timeOur = 0): Log
    {
        if (empty(self::$obj[__FUNCTION__])) {
            self::$obj[__FUNCTION__] = new Log($driver, $path, $type, $timeOur);
        }
        return self::$obj[__FUNCTION__];
    }


    public function getCache(string $driver = 'file'):Cache
    {
        if (empty(self::$obj[__FUNCTION__])) {
            self::$obj[__FUNCTION__] = new Cache($driver);
        }
        return self::$obj[__FUNCTION__];
    }


    public function getRequest():Request
    {
        if (empty(self::$obj[__FUNCTION__])) {
            self::$obj[__FUNCTION__] = new Request();
        }
        return self::$obj[__FUNCTION__];
    }
}