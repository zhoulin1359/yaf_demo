<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 11:08
 */
class RedisAddrPersonModel extends Db_RedisBase
{
    private $baseKey = 'addr_get_person_id';

    public function __construct()
    {
        parent::__construct();
        $this->handle->select(4);
    }


    public function set(string $addrId, array $personData, int $ttl = 0): bool
    {
        if ($ttl) {
            $this->ttl = $ttl;
        }
        if ($this->handle->sAdd($this->baseKey . $addrId, ($personData))) {
            $this->setExpire($this->baseKey . $addrId);
            return true;
        } else {
            return false;
        }
    }


    public function get(string $addrId): array
    {
        $result = [];
        $data = $this->handle->sMembers($this->baseKey . $addrId);
        if ($data) {
            $result = ($data);
        }
        return $result;
    }


    public function getAllKey():array {
        $result = [];
        $data = $this->handle->keys($this->baseKey.'*');
        if ($data){
            $result = $data;
        }
        return $result;
    }

    public function getAddrCount(string $addrId):int
    {
        return $this->handle->sCard($addrId);
    }

}