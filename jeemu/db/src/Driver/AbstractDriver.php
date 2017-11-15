<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:13
 */

namespace Jeemu\Db;
abstract class AbstractDriver
{
    abstract protected function conn(array $conf);

    abstract protected function getConf();
}