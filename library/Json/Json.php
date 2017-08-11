<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/20
 * Time: 15:56
 * Email: zhoulin@mapgoo.net
 */
class Json_json
{
    private $arr = [];

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function decode(){
        return json_decode($this->encode($this->arr),true);
    }

    public function encode(){
        return json_encode($this->arr);
    }

    static public function staticFunction($arr){
        return serialize(array($arr));
    }
}