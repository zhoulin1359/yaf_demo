<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/29
 * Time: 12:10
 */
class DbBrowseCountModel extends DBModel
{
    /**
     * 设置统计数据
     * @param $data
     * @param $unsetKey
     */
    public function setConutInfo($data){
        return $this->insert($data);
    }
}