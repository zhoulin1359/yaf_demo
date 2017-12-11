<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 14:53
 */
class DbAddrCodesModel extends Db_BaseBase
{
    public function addrInfoByAddrIds(array $addrIds):array {
        $result = [];
        $data = $this->dbObj->query('select `c_addr_id`,`c_name_chn`,`x_coord`,`y_coord` from '.$this->tableName.' where `c_addr_id` in ('.implode(',',$addrIds).') and `x_coord` is not null and `y_coord` is not null')->fetchAll($this->fetchStyle);
        if ($data){
            $result = $data;
        }
        return $result;
    }
}