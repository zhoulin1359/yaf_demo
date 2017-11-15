<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:16
 */

namespace Jeemu\Db;


use Medoo\Medoo;

class Mysql extends AbstractDriver
{
    public function conn(array $conf): Medoo
    {
        return new Medoo($conf);
        // TODO: Implement conn() method.
    }


    public function getConf(): array
    {
        return conf('mysql');
        // TODO: Implement getConf() method.
    }
}