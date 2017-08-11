<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/29
 * Time: 18:11
 */
class Web_Base
{
    //基础类

    protected $param;
    protected $webId;
    protected $uid;
    protected $clientIpAddress;

    public function __construct($webId,$uid,$ip,$param)
    {
        $this->webId = $webId;
        $this->uid = $uid;
        $this->clientIpAddress = $ip;
        $this->param = $param;

    }


    /**
     * 记录点击事件
     * @param $buttonName
     */
    protected function saveClickButton($buttonName){
        $insertData['ip'] = $this->clientIpAddress;
        $insertData['web_id'] = $this->webId;
        $insertData['uid'] = $this->uid ;
        $insertData['name'] = $buttonName;
        $insertData['platform'] = getClientPlatform();
        $insertData['is_weixin'] = empty(isWeixin())?0:1;
        $insertData['create_time'] = time();
        (new DbButtonCountModel())->setButtonInfo($insertData);
    }
}