<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:32
 */
class NianHaoModel extends Db_Conn
{
    protected $tableName = '123';


    protected function table(){
        var_dump($this->tableName);
    }
}