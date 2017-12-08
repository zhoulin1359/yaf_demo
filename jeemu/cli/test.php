<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/27
 * Time: 11:04
 */
declare(ticks=1);

/*register_shutdown_function(function ($a){
    var_dump(1);
    var_dump($a);
},$a);*/


function sigHandle($signo, $info)
{

    var_dump($signo);
    var_dump($info);
    switch ($signo) {
        case SIGTERM:
            break;
        case SIGHUP:
            break;
        case SIGUSR2:
            break;
        case SIGINT:
            die();
            break;
        case SIGUSR1:
            Dispatcher::getInstance()->unsetAll();
            break;
    }
}

//unset($a);
//php yaf_demo.git/svn/trunk/jeemu/cli/test.php
pcntl_signal(SIGHUP, 'sigHandle'); //终端断线 -1
pcntl_signal(SIGTERM, 'sigHandle');//终止 -15

pcntl_signal(SIGUSR1, 'sigHandle');//自定义1    -10
pcntl_signal(SIGUSR2, 'sigHandle');//自定义2   -12
pcntl_signal(SIGINT, 'sigHandle');//中断（Ctrl+C） -2
pcntl_signal(SIGQUIT, 'sigHandle');//退出（Ctrl+\） -3

//pcntl_signal(SIGKILL,'sigHandle');//强制退出
//pcntl_signal(SIGSTOP,'sigHandle'); //暂停
//pcntl_signal(SIGCONT,'sigHandle');//继续
$a = new Test();
while (true) {
    //var_dump(time());
    sleep(1);
}


class Test
{

    private $arr = [1, 2, 3];

    public function __construct()
    {
        var_dump('test start');
    }


    public function __destruct()
    {
        var_dump('test end');
        // TODO: Implement __destruct() method.
    }
}

class Dispatcher
{
    static private $handleObj;
    static private $selfHandle;

    private function __construct()
    {

    }

    public static function getInstance(): Dispatcher
    {
        if (!isset(self::$selfHandle)) {
            self::$selfHandle = new self();
        }
        return self::$selfHandle;
    }

    public function getA(): Test
    {
        if (!isset(self::$handleObj[__FUNCTION__])) {
            self::$handleObj[__FUNCTION__] = new Test();
        }
        return self::$handleObj[__FUNCTION__];
    }

    public function unsetAll()
    {
        die;
        /*foreach (self::$handleObj as $key => $value) {
            self::$handleObj[$key]->__destruct();
            unset(self::$handleObj[$key]);
        }*/

    }


    public function __destruct()
    {
        var_dump('dispatcher end');
        // TODO: Implement __destruct() method.
    }
}