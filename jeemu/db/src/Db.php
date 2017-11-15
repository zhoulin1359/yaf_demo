<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:25
 */

namespace Jeemu;

use Jeemu\Db\AbstractDriver;

class Db
{
    const REDIS = 'REDIS';
    const MYSQL = 'MYSQL';
    const CACHE = 'CACHE';


    protected static $handle;

    public static function getInstance(string $type = self::MYSQL)
    {
        if (empty(self::$handle)) {
            new self($driver);
        }
        return self::$handle;
    }

    protected function __construct(AbstractDriver $driver)
    {
        self::$handle = $driver;
    }
}