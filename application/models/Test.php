<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2018/1/4
 * Time: 11:44
 */
class TestModel extends \Jeemu\Db\Connect\Mysql
{
    /*
     * sql:  CREATE TABLE `test_test` (`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,`name`  varchar(255) NOT NULL DEFAULT '' ,`insert_time`  int(11) NOT NULL DEFAULT 0 ,PRIMARY KEY (`id`));
     */

    public function set($data): int
    {
        $this->insert($data);
        if ($id = $this->dbObj->id()) {
            return $id;
        }
        return 0;
    }


    public function getOne(int $id): array
    {
        $result = $this->get(['id', 'name'], ['id[=]' => $id]);
        if (!empty($result)) {
            return $result;
        }
        return [];
    }

    public function getAll(): array
    {
        $result = $this->select(['id', 'name']);
        if (!empty($result)) {
            return $result;
        }
        return [];
    }
}