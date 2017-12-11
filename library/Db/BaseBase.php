<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/11
 * Time: 17:42
 */
class Db_BaseBase extends Db_MysqlBase implements Db_Interface
{
    public function getType():string
    {
        return 'db';
        // TODO: Implement getType() method.
    }
}