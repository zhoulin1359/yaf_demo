<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/28
 * Time: 19:07
 */
class RedisWebModel
{
    /**
     * @var Singleton
     */
    private static $instance;

    private static $handle;

    private $redisName = 'web';

    private $expire = 86400 * 10;

    private $keyType = [
        'public_web_look_',
        'public_web_button_'
    ];
    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * 获取点击缓存
     * @param $webId
     * @return array
     */
    public function getWebButtonCache($webId){
        $redisKey = $this->getKey($webId,1);

        $redisKeyArr = self::$handle->hKeys($redisKey);
        $userNum = count($redisKeyArr);
        $redisValArr = self::$handle -> hVals($redisKey);
        $totalNum = 0;
        if (is_array($redisKeyArr)){
            foreach ($redisValArr as $value){
                $totalNum += $value;
            }
        }
        return ['user_num'=>$userNum,'total_num'=>$totalNum];
    }



    /**
     * 设置点击缓存
     * @param $uid
     * @param $buttonName
     * @param $webId
     * @param null $expire
     * @return mixed
     */
    public function setButtonCache($uid,$buttonName,$webId,$expire=null){
        if (is_null($expire)){
            $expire = $this->expire;
        }
        $redisKey = $this->getKey($webId,1);
        $field = md5($uid.$buttonName);
        if (self::$handle->hExists($redisKey,$field)){
            return self::$handle->hIncrBy($redisKey,$field,1);
        }else{
            self::$handle->hSet($redisKey,$field,1);
            return self::$handle->expire($redisKey,$expire);
        }
    }


    /**
     * 获取查看缓存
     * @param $webId
     * @return array
     */
    public function getWebLookCache($webId){
        $redisKey = $this->getKey($webId,0);

        $redisKeyArr = self::$handle->hKeys($redisKey);
        $userNum = count($redisKeyArr);
        $redisValArr = self::$handle -> hVals($redisKey);
        $totalNum = 0;
        if (is_array($redisKeyArr)){
            foreach ($redisValArr as $value){
                $totalNum += $value;
            }
        }
        return ['user_num'=>$userNum,'total_num'=>$totalNum];
    }


    /**
     * 设置查看缓存
     * @param $uid
     * @param $webId
     * @param null $expire
     * @return mixed
     */
    public function setWebLookCache($uid,$webId,$expire=null){
        if (is_null($expire)){
            $expire = $this->expire;
        }
        $redisKey = $this->getKey($webId,0);
        if (self::$handle->hExists($redisKey,$uid)){
            return self::$handle->hIncrBy($redisKey,$uid,1);
        }else{
             self::$handle->hSet($redisKey,$uid,1);
             return self::$handle->expire($redisKey,$expire);
        }
    }

    public  function setHash($key,$field,$value,$timeout=0){
        return self::$handle->hset($key,$field,$value);
    }

    private function getKey($webId,$type=0){
        return $this->keyType[$type].$webId;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {

        $redisConf = config('redis.'.SERVER_TYPE.'.'.$this->redisName);
        if (empty($redisConf)){
            ajaxReturn(null,'服务器出现问题_1319',-1);
        }
        static::$handle = new Redis();
        // self::$handle = new Redis();
        self::$handle ->connect($redisConf['host'],$redisConf['port']);
        if (isset($redisConf['select'])){
            self::$handle ->select($redisConf['select']);
        }
        if (isset($redisConf['auth'])){
            self::$handle ->auth($redisConf['select']);
        }

    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }
}