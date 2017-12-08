<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/5
 * Time: 19:28
 */

namespace Jeemu;


class Request
{
    private $quest;
    private $post;
    private $requsetHandle;
    public function __construct()
    {
        $this->requsetHandle =  \Yaf\Dispatcher::getInstance()->getRequest();
        $this->quest = \GUMP::xss_clean($this->requsetHandle->getQuery());
        $this->post = \GUMP::xss_clean($this->requsetHandle->getPost());
    }

    public function getPost(string $name,$default = null){
        return isset($this->post[$name])?$this->post[$name]:$default;
    }

    public function getQuery(string $name,$default = null){
        return isset($this->quest[$name])?$this->quest[$name]:$default;
    }
}