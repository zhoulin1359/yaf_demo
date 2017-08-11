<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2016/11/18
 * Time: 19:09
 * Email: zhoulin@mapgoo.net
 */
ini_set('yaf.use_spl_autoload',1);     //开启自定义加载
ini_set('yaf.use_namespace',false);        //命名空间

define('SERVER_TYPE','test');  //服务器类型  test demo service

define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");



$app->bootstrap()->run();


/*$loader = Yaf_Loader::getIgnstance();
$loader->registerLocalNamespace(array("Joomu", "Local"));*/