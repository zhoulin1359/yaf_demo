<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/13
 * Time: 11:06
 */
class DbAddrXyModel extends Db_BaseBase
{
    public function getXyByAddrId(array $addrId): array
    {
        $result = [];
        $data = $this->select(['c_addr_id', 'x_coord', 'y_coord'], ['c_addr_id' => $addrId,'x_coord[!]'=>NULL,'y_coord[!]'=>NULL]);
        //var_dump($this->getLog());
        if ($data) {
            $result = $data;
        }
        return $result;
    }
}