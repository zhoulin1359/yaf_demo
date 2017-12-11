<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/11
 * Time: 17:37
 */
class DbJeemuAddrModel extends Db_JeemuBase
{
    public function set(array $data):bool
    {
        $data = $this->insert($data);
        var_dump($data);
        return true;
    }
}