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
        return jsonResponse($_SERVER);

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
}