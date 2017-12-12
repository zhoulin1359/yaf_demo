<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/27
 * Time: 17:09
 */
class Db_MysqlBase implements Db_Interface
{
    protected $fetchStyle = PDO::FETCH_ASSOC;
    protected $tableName;
    protected $dbObj;
    protected $replaceArr = ['Db','Model'];

    public function __construct()
    {
        $this->dbObj = \Jeemu\Dispatcher::getInstance()->getMysql($this->getType());
        $this->getTableName();
    }


    public function getType():string
    {
        return 'db';
        // TODO: Implement getType() method.
    }

    /**
     * 查询
     * @param $select
     * @param null $where
     * @param null $table
     * @return array|bool|null
     */
    public function select($select, $where = null, $table = null)
    {
        if (is_null($table)) {
            $table = $this->tableName;
        }
        $data = $this->dbObj->select($table, $select, $where);
       /* if (empty($data)) {
            return null;
        } else {
            foreach ($data as $key => $value) {
                $data[$key] = (object)$value;
            }
        }*/
        return $data;
    }


    public function update($data,$where = null,$table =null){
        if ($table){
            $this->tableName = $table;
        }
        return $this->dbObj->update($this->tableName,$data,$where);
    }

    /**
     * 插入
     * @param $data
     * @return bool|PDOStatement
     */
    public function insert($data, $table = null)
    {
        if (is_null($table)) {
            $table = $this->tableName;
        }
        return $this->dbObj->insert($table, $data);
    }

    public function getError()
    {
        return $this->dbObj->error();
    }


    public function getLog(){
        return $this->dbObj->log();
    }

    /**
     * 表名
     */
    protected function getTableName()
    {
        if (empty($this->tableName)) {
            $this->tableName = get_class($this);
            $this->tableName = str_replace($this->replaceArr, ['',''], $this->tableName);
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