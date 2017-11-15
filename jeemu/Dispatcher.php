<?php
declare(strict_types = 1);
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

    public function getMysql(): Medoo
    {
        if (empty(self::$obj[__FUNCTION__])) {
            self::$obj[__FUNCTION__] = new Db\Mysql();
        }
        return self::$obj[__FUNCTION__];
    }


    public function getRedis(): \Redis
    {
        if (empty(self::$obj[__FUNCTION__])) {
            self::$obj[__FUNCTION__] = Db\Redis::getObj();
        }
        var_export(self::$obj[__FUNCTION__] -> select(1));
        return self::$obj[__FUNCTION__];
    }

}