<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/14
 * Time: 18:49
 */
class LogController extends  Yaf\Controller_Abstract
{
    public function indexAction(){
        //var_dump(new Jeemu\Log\Handle\File());die;
        $log =  Jeemu\Log::getInstance();

        $log->write(time());

    }
}