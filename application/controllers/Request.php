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
        jsonResponse($_SERVER);
    }
}