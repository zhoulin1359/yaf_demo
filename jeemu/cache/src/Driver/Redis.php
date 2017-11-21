<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 12:19
 */

namespace Jeemu\Cache;


use Jeemu\Dispatcher;

class Redis extends AbstractDriver
{

    private $redisConn;
    public function __construct()
    {
        $this->redisConn = Dispatcher::getInstance()->getRedis();
        $this->redisConn ->select(4);
        $this->redisConn->setOption(\Redis::OPT_SERIALIZER, (string)\Redis::SERIALIZER_PHP); //序列化
    }

   public function set(string $key,  $value, int $ttl)
   {
       if ($ttl){
           $this->ttl = $ttl;
       }
       return $this->redisConn->set($key,$value, $this->ttl);
       // TODO: Implement set() method.
   }


   public function get(string $key)
   {
       return $this->redisConn->get($key);
       // TODO: Implement get() method.
   }


   public function delete(string $key)
   {
       return $this->redisConn->del($key);
       // TODO: Implement delete() method.
   }

   public function has(string $key)
   {
        return $this->redisConn->exists($key);
       // TODO: Implement has() method.
   }

   public function clear()
   {
       $this->redisConn->flushDB();
       // TODO: Implement clear() method.
   }
}