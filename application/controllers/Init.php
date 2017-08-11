<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/24
 * Time: 15:29
 * Email: zhoulin@mapgoo.net
 */
class InitController extends Yaf_Controller_Abstract
{
    protected $param;

    protected function init()
    {
       //初始化
        $this->param = GUMP::xss_clean(array_merge($_POST,$_GET));
    }


    /**
     * 获取参数
     * @param $key
     * @return null
     */
    protected function getParam($key){
        $result = null;
        if (isset($this->param[$key])){
            $result = $this->param[$key];
        }
        return $result;
    }
}