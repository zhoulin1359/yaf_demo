<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/17
 * Time: 19:07
 */

namespace Jeemu;
class Cache implements \Psr\SimpleCache\CacheInterface
{
    private $driverHandle;

    public function __construct(string $dirverType = 'file')
    {
        switch ($dirverType) {
            case 'file':
                $this->driverHandle = new Cache\File();
                break;
            default:
                $this->driverHandle = new Cache\File();
                break;
        }

    }

    private function initKey(string  $key):string {
        return md5($key);
    }

    public function set($key, $value, $ttl = 0)
    {
        $this->driverHandle->set($this->initKey((string)$key), (string)$value, $ttl);
        // TODO: Implement set() method.
    }


    public function get($key, $default = null)
    {
        $value = $this->driverHandle->get($this->initKey((string)$key));
        if ($value) {
            return $value;
        }
        return $default;
        // TODO: Implement get() method.
    }

    public function has($key)
    {
        // TODO: Implement has() method.
    }


    public function delete($key)
    {
        $this->driverHandle->delete($this->initKey($key));
        // TODO: Implement delete() method.
    }

    public function setMultiple($values, $ttl = 0)
    {
        foreach ((array)$values as $key => $value){
            $this->set($key,$value,$ttl);
        }
        // TODO: Implement setMultiple() method.
    }

    public function getMultiple($keys, $default = null)
    {
        $result = [];
        var_dump($keys);
        var_dump($this->get(1));
        foreach ((array)$keys as $key){
            $result[] = $this->get($key)??$default;
        }
        return $result;
        // TODO: Implement getMultiple() method.
    }

    public function deleteMultiple($keys)
    {
        foreach ((array)$keys as $key){
            $result[] = $this->delete($key);
        }
        // TODO: Implement deleteMultiple() method.
    }

    public function clear()
    {
        // TODO: Implement clear() method.
    }
}