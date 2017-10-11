<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/3/14
 * Time: 11:13
 * Email: zhoulin@mapgoo.net
 */
class MysqlJeemuQrcodeModel extends MysqlConnModel
{
    public function insertQrcodeData($data){
        $sql = 'insert into '.$this->tableName.'(`url`,`icon`,`text`,`num`,`create_time`) value(\''.$data['url'].'\',\''.$data['icon'].'\',\''.$data['text'].'\','.$data['num'].','.time().')';
        //var_dump($sql);
        if(parent::$handle->exec($sql)){
            return parent::$handle ->lastInsertId();
        }else{
            return false;
        }
    }

    public function getQrcodeID(){
        $sth = parent::$handle->prepare('select id from '.$this->tableName);
        $sth ->execute();
        return $sth ->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_OBJ);
    }
}