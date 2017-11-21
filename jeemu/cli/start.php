<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/21
 * Time: 22:21
 */
spl_autoload_register(function ($class) {
    $path = './'.$class . '.php';
    if (is_file($path)) {
        require_once($path);
    }
});

class start
{
    public function run()
    {
        $redis = new CliRedis();
        $file = new CliFile('./data/' . date('Ymd'), date('Ymd') . '.log');
        while (true) {
            $redisLog = $redis->getLog();
            if (empty($redisLog)){
                echo '没有数据'."\r\n";
                sleep(10);
                continue;
            }
            $redisLogArr = explode('|',$redisLog);
            //var_dump($redisLog);die;
            $file->saveLog('./data/'.date('Ymd',strtotime($redisLogArr[1])),date('Ymd',strtotime($redisLogArr[1])).'.log',$redisLog."\r\n");
        }
    }
}

(new start())->run();