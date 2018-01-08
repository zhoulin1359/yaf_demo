<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/17
 * Time: 20:39
 */
class CacheController extends BaseController
{
    /**
     * 设置缓存
     */
    public function setAction(){
        $cache = \Jeemu\Dispatcher::getInstance()->getCache('file');
        $result = $cache->set('a','zh中午',2);
        jsonResponse([$result]);
    }


    /**
     * 获取缓存
     */
    public function getAction(){
        $cache = \Jeemu\Dispatcher::getInstance()->getCache('file');
        jsonResponse([$cache->get('a')]);
    }

    /**
     * 删除单个
     */
    public function delAction(){
        $cache = \Jeemu\Dispatcher::getInstance()->getCache('file');
        jsonResponse([$cache->delete('a')]);
    }

    /**
     * 清除缓存-所有的缓存
     */
    public function clearAction(){
        \Jeemu\Dispatcher::getInstance()->getCache('file')->clear();
        jsonResponse();
    }
}