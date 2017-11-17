<?php

/**
 * Created by PhpStorm.
 * User: jeemu
 * Date: 2016/11/18
 * Time: 19:09
 * Email: jeemu@wearke.net
 */
//declare( strict_types = 1);                                  //标量声明
date_default_timezone_set('PRC');        //时区
//ini_set('yaf.use_namespace','1');        //命名空间-不起作用，必须在php.ini中配置
ini_set('yaf.use_spl_autoload','0');     //开启自定义加载，鸟哥不建议开启，如果有特别需要，比如加载ice扩展，请打开


define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
$app  = new Yaf\Application(APP_PATH . "/conf/application.ini");
//snn
//var_dump(application.ext);
//var_dump($app::app());
//var_dump($app->environ());
//var_dump($app->getConfig('application'));
//var_dump($app->getModules());

$app->bootstrap()->run();
