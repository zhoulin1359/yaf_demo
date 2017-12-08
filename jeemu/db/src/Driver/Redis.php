<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:19
 */

namespace Jeemu\Db;


class Redis extends AbstractDriver
{
    protected function conn(array $conf): \Redis
    {
        $obj = new \Redis();
        $obj->connect($conf['host'], isset($conf['port']) ? $conf['port'] : 6379);
        if (!empty($conf['auth'])) {
            $obj->auth($conf['auth']);
        }
        if (!empty($conf['select'])) {
            $obj->select($conf['select']);
        }
        return $obj;
        // TODO: Implement conn() method.
    }

    protected function getConf(string $conf = 'redis'): array
    {
        return $this->conf??conf($conf);
        // TODO: Implement getConf() method.
    }
}