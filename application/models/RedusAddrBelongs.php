<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 16:05
 */
class RedusAddrBelongsModel extends Db_RedisBase
{
    protected $redisKey = 'addr_belongs';
    private $baseKey = 'addr_belongs_parent';
    static private $data;

    public function __construct()
    {
        parent::__construct();
        $this->handle->select(4);
        $this->handle->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
        /**/
    }


    public function getParent(int $id): array
    {
        $data = $this->handle->get($this->baseKey . $id);
        if ($data) {
            return (array)$data;
        }
        return $this->getParentZero($id);
    }


    private function getParentZero(int $id): array
    {
        $result = [];
        $pid = 0;
        $this->initData();
        foreach (self::$data as $value) {
            if ($id === $value['id'] && $value['pid'] !== null) {
                $pid = $value['pid'];
            }
        }
        if (empty($pid)) {
            $this->setParent($id, $result);
            return $result;
        }
        while (true) {
            $oldPid = $pid;
            foreach (self::$data as $value) {
                if ($pid == $value['id'] && $value['pid'] !== null) {
                    $result[] = $value['id'];
                    $pid = $value['pid'];
                    break;
                }
            }
            if ($oldPid === $pid) {
                break;
            }
        }
        $this->setParent($id, $result);
        return $result;
    }

    private function getParentOne(int $id){

    }

    private function setParent(int $id, array $value, $ttl = 0): bool
    {
        if ($ttl) {
            $this->ttl = $ttl;
        }
        if ($this->handle->set($this->baseKey . $id, $value)) {
            $this->setExpire($this->baseKey . $id);
        }
        return true;

    }





    private function initData()
    {
        if (empty(self::$data)) {
            $redisData = $this->handle->get($this->redisKey);
            if ($redisData) {
                self::$data = ($redisData);
            } else {
                $mysqlData = (new DbAddrBelongsModel())->getBelongs();
                foreach ($mysqlData as $key => $value) {
                    $mysqlData[$key] = ['id' => (int)$value['id'], 'pid' => (int)$value['pid']];
                }
                $this->handle->set($this->redisKey, ($mysqlData));
                self::$data = $mysqlData;
            }
        }
    }
}