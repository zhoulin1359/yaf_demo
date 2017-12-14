<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/11
 * Time: 17:37
 */
class DbJeemuAddrModel extends Db_JeemuBase
{
    public function set(array $data): bool
    {
        $data = $this->insert($data);
        //var_dump($data);
        if ($this->dbObj->id()) {
            return true;
        }
        return false;
    }


    public function getByLngAntLat(array $param): array
    {
        $result = [];
        $data = $this->select(['id', 'gaode_lng', 'gaode_lat'], [
            'gaode_lng[>=]' => $param['min_lng'],
            'gaode_lng[<=]' => $param['max_lng'],
            'gaode_lat[>=]' => $param['min_lat'],
            'gaode_lat[<=]' => $param['max_lat']
        ]);
        //var_dump($this->getLog());
        //var_dump($data);die;
      /*  var_dump($param);
        var_dump($this->getLog());
        var_dump($data);
        var_dump($this->getError());*/
        if ($data) {
            $result = $data;
        }
        return $result;
    }


    public function get(): array
    {
        $result = [];
        $data = $this->select(['id', 'lng', 'lat']);
        if ($data) {
            $result = $data;
        }
        return $result;
    }


    public function updateById($data, $id): bool
    {
        $result = $this->update($data, ['id[=]'=>$id]);
        return $result->rowCount() ? true : false;
    }
}