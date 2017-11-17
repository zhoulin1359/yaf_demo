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
        $cache = \Jeemu\Dispatcher::getInstance()->getCache();
        $cache->set(time(),time());
        var_dump($cache->get(time()));

        $a = $cache->get('a');
        var_dump($a);
        $cache->delete('a');

        $arr = range(1,10);

        $cache->setMultiple($arr);
        var_dump($cache->getMultiple(array_keys($arr)));
    }
}