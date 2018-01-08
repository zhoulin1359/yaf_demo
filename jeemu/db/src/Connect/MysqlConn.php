<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2018/1/4
 * Time: 11:12
 */

namespace Jeemu\Db\Connect;


class MysqlConn extends Mysql implements AbstractConn
{
    public function getType(): string
    {
        return 'db';
    }
}