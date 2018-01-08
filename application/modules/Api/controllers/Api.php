<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2018/1/4
 * Time: 15:51
 */
class ApiController extends BaseController
{
    public function routerAction(){
        jsonResponse(['index.php?m=api&c=api&a=router']);
    }
}