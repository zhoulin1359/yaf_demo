<?php
/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/3/3
 * Time: 16:26
 * Email: zhoulin@mapgoo.net
 */

return array(
    //Redis 配置
    'redis' => array(
        'host' => '10.0.75.1',
        'port' => 6379,
        'auth' => '123456',
        'select' => 1
    ),
    //数据库
    'db' => [
        // required
        'database_type' => 'mysql',
        'database_name' => 'history_base',
        'server' => '10.0.75.1',
        'username' => 'root',
        'password' => '1234',

        // [optional]
        'charset' => 'utf8',
        'port' => 3306,

        // [optional] Table prefix
        'prefix' => '',

        // [optional] Enable logging (Logging is disabled by default for better performance)
        'logging' => true
    ],
    //开发模式
    'debug' => false
);
