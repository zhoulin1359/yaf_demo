<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/5
 * Time: 19:18
 */
class RequestController extends BaseController
{
    /**
     * 获取get参数
     */
    public function getAction(){
        jsonResponse([\Jeemu\Dispatcher::getInstance()->getRequest()->getQuery('get')]);
    }


    /**
     * 获取post参数
     */
    public function postAction(){
        jsonResponse([\Jeemu\Dispatcher::getInstance()->getRequest()->getPost('get')]);
    }


    /**
     * 上传文件
     * @return bool
     */
    public function fileAction(){
        $upload = \Jeemu\Dispatcher::getInstance()->getUpload($_FILES['file']);
        if (!$upload->check(['extension' => ['png', 'jpg', 'jpeg', 'gif'], 'max_size' => 1024 * 1024 * 10, 'mime_type' => ['image/png', 'image/jpeg', 'image/jpg', 'image/gif']])) {
            return jsonResponse([], -1, $upload->getError());
        }
        $result = $upload->moveTo();
        jsonResponse([$result]);
    }

}