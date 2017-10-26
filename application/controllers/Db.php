<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:37
 */
class DbController extends Yaf\Controller_Abstract
{
    public function indexAction(){
        NianHaoModel::getInstance()->table();
    }
}