<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/5
 * Time: 19:18
 */
class RequestController extends BaseController
{
    public function indexAction(){
        var_dump($this->getRequest());
        var_dump($this->getRequest()->getQuery('ee1'));
        var_dump($this->getRequest()->post);

        var_dump(\Jeemu\Dispatcher::getInstance()->getRequest()->getQuery('ee'));
        var_dump(\Jeemu\Dispatcher::getInstance()->getRequest()->getPost('ee'));
    }
}