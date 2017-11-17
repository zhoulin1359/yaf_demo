<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:16
 */

namespace Jeemu\Cache;


use Medoo\Medoo;

class Mysql extends AbstractDriver
{
    protected function conn(array $conf): Medoo
    {
        return new Medoo($conf);
        // TODO: Implement conn() method.
    }


    protected function getConf(): array
    {
        return $this->conf??conf('db');
        // TODO: Implement getConf() method.
    }
}