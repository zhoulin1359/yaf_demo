<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/16
 * Time: 17:50
 */
class RouterController extends BaseController
{
    /**
     * 默认路由
     */
    public function indexAction(){
        jsonResponse(['url'=>'/home/router/index']);
    }

    /**
     * simple路由
     * 在 Boostrap 的 _initRouter 方法中注册
     */
    public function otherAction(){
        jsonResponse(['url'=>'index.php?m=home&c=router&a=other']);
    }
}