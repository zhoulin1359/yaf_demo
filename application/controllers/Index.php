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
        jsonResponse($_SERVER);
        throw new ErrorException('sss',1);
       // die;
        //$route = new Yaf\Route_Simple("m", "controller", "act");
        //jsonResponse($_SERVER);
    }

    public function phpInfoAction(){
        phpinfo();
    }

    /**
     * 自动加载
     * 区分全局类和本地类
     * 全局类在php.ini里配置的
     * 本地类用registerLocalNamespace()注册
     */
    public function autoloadAction()
    {
        jsonResponse($this->getResponse(),[Test_Test::hello()]);
    }

    /**
     * 获取自定义配置项
     */
    public function confAction(){
        jsonResponse($this->getResponse(),[conf('redis'),conf('as')]);
        jsonResponse($this->getResponse(),[conf('11'),conf('as')]);
    }



    public function responseAction(){
        $this->getResponse()->setHeader('Content-Type','application/json;charset=utf-8');
        return $this->getResponse()->setBody("Hello World");
    }
}