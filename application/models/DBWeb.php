<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/6/26
 * Time: 14:31
 */
class DbWebModel extends DBModel
{

    public function getWebInfoById($id){
        return $this->selectOne(['id','title','tpl','show_conf','start_time','end_time','start_show_time','end_show_time','status'],['id[=]'=>$id]);
    }



    public function getWebInfoById1($id){
        return $this->selectOne(['id','title']);
    }


    public function getWebListByName(){
        return parent::$handle->select($this->tableName,[
          'id','name'
        ],[
            'name[!]'=>'',
            'LIMIT'=>[0,1]
        ]);
    }


    public function insertWebInfo($data){
        $check =  parent::$handle->insert($this->tableName,$data);
        if ($check){
            return parent::$handle->id();
        }else{
            return false;
        }
    }


    public function insertLogInfo($data){
        return parent::$handle->action(function ($db) use ($data){
            $db->insert($this->tableName,$data);
            $lastId = $db->id();
            $db->insert('log',['log_info'=>$lastId]);
            $last1Id = $db->id();
            if ($last1Id && $lastId){
                return true;
            }else{
                return false;
            }
        });

    }
}