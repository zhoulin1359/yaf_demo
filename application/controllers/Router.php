<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/16
 * Time: 17:50
 */
class RouterController extends Yaf\Controller_Abstract
{
    public function indexAction(){
        jsonResponse($this->getResponse(),[]);
    }
}