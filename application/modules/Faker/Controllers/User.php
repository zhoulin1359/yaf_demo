<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/8
 * Time: 12:19
 */
class UserController extends InitController
{
    public function indexAction(){
        $faker = \Faker\Factory::create('zh_CN');
        for($i = 0 ;$i <100;$i++){
            $result[$i]['id'] = $i;
            $result[$i]['name'] = $faker->name;
            $result[$i]['email'] = $faker->email;
            $result[$i]['address'] = $faker->address;
            $result[$i]['content'] = $faker->text(100);
            $result[$i]['name'] = $faker->name;
            $result[$i]['text'] = $faker->company;
           // $result[$i]['image'] = $faker->image();
        }
        $result[$i]['content'] = $faker->realText(20000);
        return Bootstrap::jsonResponse($result);
        var_dump($faker->address);
    }
}