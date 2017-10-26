<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:26
 */
class Db_Conn
{

    protected static $instance;
    protected static $handle;

    protected $tableName;


    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function select($select,$where =null,$table=null){
        if (is_null($table)){
            $table = $this->tableName;
        }
        $data =  self::$handle->select($table,$select,$where);
        if (empty($data)){
            return null;
        }else{
            foreach ($data as $key => $value){
                $data[$key] = (object)$value;
            }
        }
        return $data;
    }

    /**
     * 插入
     * @param $data
     * @return bool|PDOStatement
     */
    public function insert($data,$table = null)
    {
        if (is_null($table)){
            $table = $this->tableName;
        }
        return self::$handle->insert($table, $data);
    }

    public function getError(){
        return self::$handle->error();
    }

    public function __construct()
    {
        self::$handle = new \Medoo\Medoo(conf('db'));
        $this->getTableName();
    }

    protected function getTableName()
    {
        var_dump($this->tableName);die();
        if (empty($this->tableName)) {
            $this->tableName = get_class($this);
            $this->tableName = str_replace('Model', '', $this->tableName);
            for ($i = 0; $i < mb_strlen($this->tableName); $i++) {
                if ($i === 0) {
                    $this->tableName[$i] = strtolower($this->tableName[$i]);
                } elseif (strtoupper($this->tableName[$i]) === $this->tableName[$i] && $i !== 0 /*&&  $this->tableName[$i] !== '_'*/) {
                    for ($j = mb_strlen($this->tableName); $j > $i; $j--) {
                        if ($j === $i + 1) {
                            $this->tableName[$j] = strtolower($this->tableName[$j - 1]);
                        } else {
                            $this->tableName[$j] = $this->tableName[$j - 1];
                        }
                    }
                    $this->tableName[$i] = '_';
                }
            }
            var_dump($this->tableName);die();
        }
    }
}