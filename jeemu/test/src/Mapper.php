<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 14:58
 */

namespace Jeemu\Test;


use Medoo\Medoo;

abstract class Mapper
{
    protected static $dbObj;

    protected $tableName = '';

    public function __construct()
    {
        if (!isset(self::$dbObj)) {
            self::$dbObj = new Medoo(conf('db'));
        }
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

        $data = self::$dbObj->select($table, $select, $where);

        /* if (empty($data)) {
             return null;
         } else {
             foreach ($data as $key => $value) {
                 $data[$key] = (object)$value;
             }
         }*/
        $col = new Collection($data, $this);
        $result = [];
        while ($ckeck = $col->next()) {
            $result[] = $ckeck;
        }
        return $result;
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
        return self::$dbObj->insert($table, $data);
    }

    public function getError()
    {
        return self::$dbObj->error();
    }


    public function createObj(array $arr)
    {
        $obj = new class($arr)
        {
            public function __construct($arr)
            {
                foreach ($arr as $key => $value) {
                    $this->$key = $value;
                }
            }
        };

        return $obj;
    }

    abstract protected function selectStmt();
}