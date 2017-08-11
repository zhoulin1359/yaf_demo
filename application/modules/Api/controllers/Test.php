<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/24
 * Time: 15:30
 * Email: zhoulin@mapgoo.net
 */
class TestController extends InitController
{
    public function indexAction(){
      // parent::init();
        var_dump('2');
    }

    public function redisAction(){
        $redicConn = RedisConnModel::getInstance();
        $redicConn = RedisConnModel::getInstance();
        $redicConn ->set(1,1);
    }

    public function mysqlAction(){
        $mysqlConn = MysqlConnModel::getInstance();
        var_dump($mysqlConn->query('select * from sys_user'));
    }

    public function testAction(){
        var_dump($startTime = microtime(true));
        $redicConn = RedisConnModel::getInstance();
        $data = $redicConn -> hgetAll('statistics:124941');

        print_r($data);
        $data = $redicConn -> hmget('statistics:1',['enginstopobjList','enginstartobjList']);
        $datalist = explode(',',$data['enginstopobjList']);
        var_dump($datalist);
        var_dump($data);
        var_dump(microtime(true)-$startTime);
        die();

    }
}