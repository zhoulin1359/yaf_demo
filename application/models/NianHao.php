<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:32
 */
class NianHaoModel extends Db_Base
{

    public function table()
    {
        return ($this->select(['c_nianhao_id','c_dy','c_dynasty_chn','c_nianhao_chn','c_firstyear','c_lastyear'],['c_nianhao_id[>]'=>0]));
        //var_export();
    }
}