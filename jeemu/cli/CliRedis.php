<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/21
 * Time: 22:21
 */
class CliRedis
{
    private $redisConn;
    private $redisKey;

    public function __construct(string $redisKey = './runtime/2017/11/21.log')
    {
        $this->redisConn = new \Redis();
        $this->redisConn->pconnect(/*'172.17.0.3'*/
            '127.0.0.1', 6379, 2.1);
        $this->redisConn->select(3);
        $this->redisKey = $redisKey;
    }

    private function connect()
    {
        $this->redisConn = new \Redis();
        $this->redisConn->pconnect(/*'172.17.0.3'*/
            '127.0.0.1', 6379, 2.1);
        $this->redisConn->select(3);
    }

    public function getLog()
    {
        if (!$this->redisConn->isConnected()) {
            $this->connect();
        }
        return ($this->redisConn->lPop($this->redisKey));
    }

    public function setLog(string $data)
    {
        return $this->redisConn->lPush($this->redisKey, $data);
    }

    public function __destruct()
    {
        $this->redisConn->close();
        // TODO: Implement __destruct() method.
    }
}