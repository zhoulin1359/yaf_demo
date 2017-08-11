<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/1/4
 * Time: 11:47
 * Email: zhoulin@mapgoo.net
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{


    /**
     * 初始化项目配置
     */
    public function _initSetting(){
        Yaf_Dispatcher::getInstance()->disableView();   //关闭自动调用引擎render方法；

        //Yaf_Loader::getInstance()->registerLocalNamespace(array("Foo", "Bar"));  //注册本地类前缀
    }

    /**
     * 自定义文件加载；yaf已经实现自动加载，扩充
     */
    public function _initAutoload(){
        Yaf_loader::import(APP_PATH.'/vendor/autoload.php');
        Yaf_loader::import(APP_PATH.'/bootstrap/Common.php');
        spl_autoload_register('Bootstrap::userAutoload');
    }

    /**
     * 自定义加载具体实现
     * @param $class 类名
     */
    public static function userAutoload($class){
        $file = APP_PATH.'/library/Autoload/'.$class.'.php';
        if (is_file($file)){
            Yaf_loader::import($file);  //可以使用 require_once，但鸟哥说Yaf_loader::import()效率更高
        }
    }


    /**
     * 加载配置项；读取配置文件保存到对象注册表中
     *
     */
    public function _initConfig(){
        $configFile = APP_PATH.'/conf/config.php';
        if (is_file($configFile)){
            $config =  require_once($configFile);
            Yaf_Registry::set('config',$config);
        }
    }

}