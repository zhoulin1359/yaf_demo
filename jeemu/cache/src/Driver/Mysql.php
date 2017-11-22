<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:16
 */

namespace Jeemu\Cache;


use Jeemu\Dispatcher;
use Medoo\Medoo;

class Mysql extends AbstractDriver
{

    private $mysqlHandle;
    private $tableName = 'test_cache';

    public function __construct()
    {
        //CREATE TABLE `test_cache` (`key` char(32) NOT NULL,`value` tinytext NOT NULL COMMENT '值',`expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',`insert_time` int(11) NOT NULL DEFAULT '0' COMMENT '插入时间',PRIMARY KEY (`key`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        $this->mysqlHandle = Dispatcher::getInstance()->getMysql('db_log');
    }

    public function set(string $key, $value, int $ttl):bool
    {
        if ($ttl) {
            $this->ttl = $ttl;
        }
        $result = $this->mysqlHandle->insert($this->tableName, ['key' => $key, 'value' => serialize($value), 'expire_time' => time() + $this->ttl, 'insert_time' => time()])->rowCount();
        return $result ? true : false;
        // TODO: Implement set() method.
    }

    public function get(string $key)
    {
        $data =  $this->mysqlHandle->get($this->tableName,['value','expire_time'], ['key[=]' => $key]);
        if ($data){
            if ($data['expire_time'] < time()){
                $this->delete($key);
                return null;
            }
            return unserialize($data['value']);
        }
        return null;
        // TODO: Implement get() method.
    }

    public function delete(string $key):bool
    {
        $this->mysqlHandle->delete($this->tableName,['key[=]'=>$key]);
        return true;
        // TODO: Implement delete() method.
    }

    public function has(string $key):bool
    {
        //SELECT EXISTS(SELECT 1 FROM `test_cache` WHERE `key` = '0cc175b9c0f1b6a831c399e269772661'
        return $this->mysqlHandle->has($this->tableName,['key[=]'=>$key]);
        // TODO: Implement has() method.
    }

    public function clear():bool
    {
        $this->mysqlHandle->exec('TRUNCATE TABLE `test_cache`');
        return true;
        // TODO: Implement clear() method.
    }
}