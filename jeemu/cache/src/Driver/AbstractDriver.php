<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:13
 */

namespace Jeemu\Cache;
abstract class AbstractDriver
{
    protected $ttl = 86400;



    abstract public function set(string $key, string $value);

    abstract public function get(string $key);

    abstract public function delete(string $key);

    abstract public function has(string $key);
}