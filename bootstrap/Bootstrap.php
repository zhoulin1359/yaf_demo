<?php

/**
 * Created by PhpStorm.
 * User: jeemy
 * Date: 2017/1/4
 * Time: 11:47
 * Email: jeemy@wearke.net
 */
class Bootstrap extends Yaf\Bootstrap_Abstract
{


    /**
     * 初始化项目配置
     */
    public function _initSetting(){
        Yaf\Dispatcher::getInstance()->disableView();   //关闭自动调用引擎render方法；

        Yaf\Loader::getInstance()->registerLocalNamespace(array("Foo", "Bar"));  //注册本地类前缀
    }

    /**
     * 自定义文件加载；yaf已经实现自动加载，扩充
     */
    public function _initAutoload(){
        Yaf\loader::import(APP_PATH.'/vendor/autoload.php'); //composer
        Yaf\loader::import(APP_PATH.'/bootstrap/common.php'); //自定义方法
       spl_autoload_register('Bootstrap::userAutoload');
    }

    /**
     * 自定义加载具体实现
     * @param $class 类名
     */
    public static function userAutoload($class){
        $file = APP_PATH.'/library/Autoload/'.$class.'.php';
        if (is_file($file)){
            Yaf\loader::import($file);  //可以使用 require_once，但Yaf_loader::import()效率更高
        }
    }


    /**
     * 加载配置项；读取配置文件保存到对象注册表中
     *
     */
    public function _initConfig(){
        $configFile = APP_PATH.'/conf/config.php';
        if (is_file($configFile)){
            $config = file_get_contents($configFile);
            Yaf\Registry::set('config',$config);
        }
    }


}