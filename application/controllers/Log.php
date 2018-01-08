<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/14
 * Time: 18:49
 */
class LogController extends  BaseController
{
    /**
     * 进程结束自动写入
     */
    public function recordAction(){
        $log = \Jeemu\Dispatcher::getInstance()->getLog('file');
        jsonResponse([$log->record(time())]);
    }


    /**
     * 实时写入
     */
    public function writeAction(){
        $log = \Jeemu\Dispatcher::getInstance()->getLog('redis');
        jsonResponse([$log->write(time())]);
    }

}