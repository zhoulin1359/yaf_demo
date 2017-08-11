<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/3/4
 * Time: 16:15
 * Email: zhoulin@mapgoo.net
 */
class SchoolsController extends InitController
{
    public function indexAction(){
        var_dump(1);
        $str = 'A.c.D';
        $strArr = explode('.',$str);
        var_dump($strArr);
        unset($strArr[0]);
        var_dump($strArr);
    }
}