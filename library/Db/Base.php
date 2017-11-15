<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/27
 * Time: 17:09
 */
class Db_Base
{
    protected $tableName;
    protected $dbObj;

    public function __construct()
    {
        $this->dbObj = Db_MysqlConn::getInstance();
        $this->getTableName();
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

    /**
     * 表名
     */
    protected function getTableName()
    {
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
        }
    }
}