<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 15:56
 */
class DbAddrBelongsModel extends Db_BaseBase
{
    protected $tableName = 'addr_belongs_data';

    public function getBelongs(): array
    {
        $result = [];
        $data = $this->dbObj->query('select `c_addr_id` as `id`,`c_belongs_to` as `pid` from ' . $this->tableName)->fetchAll($this->fetchStyle);
        if ($data) {
            $result = $data;
        }
        return $result;
    }
}