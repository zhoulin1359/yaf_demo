<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/8
 * Time: 0:29
 */
class DBModel
{

    protected static $handle;

    protected $tableName;


    /**
     * 查询
     * @param $select
     * @param null $where
     * @param null $table
     * @return null
     */
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
     * 查询一个
     * @param $select
     * @param null $where
     * @param null $table
     * @return mixed
     */
    public function selectOne($select,$where=null,$table=null){
        if (is_null($table)){
            $table = $this->tableName;
        }
        return self::$handle->get($table,$select,$where);
    }


    /**
     * 更新数据
     * @param $data
     * @param $where
     * @param null $table
     * @return mixed
     */
    public function update($data,$where,$table=null){
        if (is_null($table)){
            $table = $this->tableName;
        }
        return self::$handle->update($table,$data,$where);
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

    public function __construct()
    {
        self::$handle = DbConnModel::getInstance(SERVER_TYPE);
        $this->getTableName();
    }

    protected function getTableName()
    {
        if (empty($this->tableName)) {
            $this->tableName = get_class($this);
            $this->tableName = str_replace(['Model','Db'], ['',''], $this->tableName);
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
        }
    }
}