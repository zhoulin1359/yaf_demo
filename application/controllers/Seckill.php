<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/22
 * Time: 0:10
 */
class SeckillController extends BaseController
{
    public function indexAction(){
        $seckill = new SeckillModel();
        $seckill->add(uniqid());

        \Jeemu\Dispatcher::getInstance()->getRedis()->incr('num');
        jsonResponse();
    }

}