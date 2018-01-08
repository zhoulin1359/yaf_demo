<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:37
 */
class DbController extends BaseController
{
    /**
     * insert
     */
    public function setAction(){

        $model = new TestModel();
        $id = $model->set(['name'=>'测试数据','insert_time'=>time()]);
        jsonResponse([$id]);
    }


    /**
     * 获取一个
     */
    public function getOneAction(){
        $model = new TestModel();
        jsonResponse($model->getOne(3));
    }


    /**
     * 获取所有
     */
    public function getAllAction(){
        $model = new TestModel();
        jsonResponse($model->getAll());
    }
}