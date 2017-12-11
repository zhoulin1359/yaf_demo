<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 10:21
 */
class DbBiogAddrDataModel extends Db_BaseBase
{

    public function getAddrData($start, $end, $default = null)
    {
        $data = $this->dbObj->query('select `c_personid`,`c_addr_id`,`c_addr_type` from ' . $this->tableName . ' where `c_personid` is not null and `c_addr_id` is not null limit ' . $start . ',' . $end)->fetchAll($this->fetchStyle);
        if (empty($data)) {

            return $default;
        }
        return $data;
    }
}