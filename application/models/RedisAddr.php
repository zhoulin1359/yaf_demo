<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 11:21
 */
class RedisAddrModel extends Db_RedisBase
{
    protected $redisKey = 'addr_set';

    public function __construct()
    {
        parent::__construct();
        $this->handle->select(4);
    }

    public function set(int $addr, int $ttl = 0): bool
    {
        if ($ttl) {
            $this->ttl = $ttl;
        }
        if ($this->handle->sAdd($this->redisKey, $addr)) {
            $this->setExpire($this->setExpire($this->redisKey));
            return true;
        } else {
            return false;
        }
    }

    public function get(): array
    {
        $result = [];
        $data = $this->handle->sMembers($this->redisKey);
        if ($data) {
            $result = $data;
        }
        return $result;
    }

    public function getAllKey(): array
    {
        $result = [];
        $data = $this->handle->sMembers($this->redisKey);
        if ($data) {
            $result = $data;
        }
        return $result;
    }


}