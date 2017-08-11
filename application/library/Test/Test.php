<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/20
 * Time: 15:29
 * Email: zhoulin@mapgoo.net
 */
class Test_Test
{
    private $arr = [];
    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    static public function json(){
        return json_encode(self::$arr);
    }
}