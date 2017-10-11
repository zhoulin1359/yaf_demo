<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/2/24
 * Time: 17:15
 * Email: zhoulin@mapgoo.net
 */
class MysqlConnModel
{
    /**
     * @var Singleton
     */
    protected static $instance;

    protected static $handle;

    protected $tableName = '';

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function showTable()
    {
        $th =  self::$handle->prepare('desc '.$this->tableName);
        $th->execute();
        return $th->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {

        self::$handle = new PDO('mysql:dbname=jeemu;host=127.0.0.1', 'root', '1234');
        //self::$handle->query()
        //return $mysql;
        if (empty($this->tableName)) {
            $this->tableName = get_class($this);
            $this->tableName = str_replace(array('Model','Mysql'), '', $this->tableName);
            for ($i = 0; $i < mb_strlen($this->tableName); $i++) {
                if ($i === 0) {
                    $this->tableName[$i] = strtolower($this->tableName[$i]);
                } elseif (strtoupper($this->tableName[$i]) === $this->tableName[$i] && $i !== 0 /*&&  $this->tableName[$i] !== '_'*/) {
                    for ($j = mb_strlen($this->tableName); $j > $i; $j--) {
                        if ($j === $i+1) {
                            $this->tableName[$j] = strtolower($this->tableName[$j - 1]);
                        }else{
                            $this->tableName[$j] =  $this->tableName[$j-1];
                        }
                    }
                    $this->tableName[$i] = '_';
                }
            }
            //as_ascer_f_feef
        }
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }
}