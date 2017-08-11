<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/20
 * Time: 18:05
 * Email: zhoulin@mapgoo.net
 */
class IndexController extends Yaf_Controller_Abstract
{
    public function indexAction(){
        die(json_encode(array('status'=>1,'info'=>null,'data'=>[1,2,3])));
    }

}