<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/11
 * Time: 17:38
 */
class Db_JeemuBase extends Db_MysqlBase implements Db_Interface
{
    protected $replaceArr = ['Jeemu','Db','Model'];

    public function getType():string
    {
        return 'db_jeemu';
        // TODO: Implement getType() method.
    }
}