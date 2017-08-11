<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/29
 * Time: 17:34
 */
class DbButtonCountModel extends DBModel
{
    public function setButtonInfo($data){
        return self::insert($data);
    }
}