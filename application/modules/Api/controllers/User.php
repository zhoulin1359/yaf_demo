<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/3/15
 * Time: 17:15
 * Email: zhoulin@mapgoo.net
 */
class UserController extends InitController
{
    public function userInfoAction(){
        //sleep(4);
        Bootstrap::jsonResponse(
            [
                'nickname'=>'jeemu',
                'avator'  =>'http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg',
                'wood_num'=>'123',
                'address' =>'广东 深圳'
            ]
        );
    }

    public function byIDAction(){
        var_dump($_SERVER);
    }
}