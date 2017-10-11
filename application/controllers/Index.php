<?php

/**
 * Created by PhpStorm.
 * User: jeemu
 * Date: 2016/11/18
 * Time: 19:23
 * Email: jeemu@wearke.net
 */
class IndexController extends Yaf\Controller_Abstract
{
    //默认Action
    public function indexAction()
    {
        jsonResponse($_SERVER, '1');
    }


    public function autoloadAction()
    {
        //jsonResponse([Test_Test::hello()]);
       // jsonResponse([(new Jeemu_Name_Home())->getHome()]);
        var_dump(Yaf\Dispatcher::returnResponse());

       // $response->setBody("Hello")->setBody(" World", "footer");
    }


    public function responseAction(){
        $this->getResponse()->setHeader('Content-Type','application/json;charset=utf-8');
        return $this->getResponse()->setBody("Hello World");
    }
}