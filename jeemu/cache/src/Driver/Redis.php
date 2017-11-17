<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:19
 */

namespace Jeemu\Cache;


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

    protected function getConf(): array
    {
        return $this->conf??conf('redis');
        // TODO: Implement getConf() method.
    }
}