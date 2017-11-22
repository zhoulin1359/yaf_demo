<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/17
 * Time: 20:39
 */
class CacheController extends BaseController
{
    public function indexAction(){
        $cache = \Jeemu\Dispatcher::getInstance()->getCache('mysql');
        $cache->set('a','zh中午',2);
        var_dump($cache->get('a'));
       // $cache->clear();
        var_dump($cache->has('a'));
    }

    public function clearAction(){
        \Jeemu\Dispatcher::getInstance()->getCache('file')->clear();
        jsonResponse();
    }
}