<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 15:03
 */
class RedisAddrGeoModel extends Db_RedisBase
{
    protected $redisKey = 'addr_geo';

    public function __construct()
    {
        parent::__construct();
        $this->handle->select(4);
    }

    public function set(string $long, string $lat, int $member, int $ttl = 0): bool
    {
        if ($ttl) {
            $this->ttl = $ttl;
        }
        if ($this->handle->geoAdd($this->redisKey, $long, $lat, $member)) {
            $this->setExpire($this->redisKey);
            return true;
        } else {
            return false;
        }
    }


    public function search(string $long,string $lat,int $radius,$unit = 'km'):array {
        $result = [];
        $data = $this->handle->geoRadius($this->redisKey,$long,$lat,$radius,$unit);
        if ($data){
            $result = $data;
        }
        return $result;
    }


    public function del(): bool
    {
        $this->handle->delete($this->redisKey);
        return true;
    }
}