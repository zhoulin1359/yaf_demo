<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/8
 * Time: 14:12
 */
class AddrController extends BaseController
{
    public function indexAction(){
        $redisAddrModel = new RedisAddrPersonModel();
        $data = ($redisAddrModel->getAllKey());
        $dataAll = [];
        foreach ($data as $value){
            $dataAll[$value] = $redisAddrModel->getAddrCount($value);
        }
       // var_dump($dataAll);
        arsort($dataAll);
        var_dump($dataAll);
    }


    public function addrXyAction(){
        $redisAddrModel = new RedisAddrModel();
        $addrIds = $redisAddrModel->get();
        $addrModel = new  DbAddrCodesModel();
        $data = $addrModel->addrInfoByAddrIds($addrIds);
       // var_dump($addrModel->getLog());
        //var_dump($data);
        $redisAddrGeoModel = new RedisAddrGeoModel();
        $redisAddrGeoModel->del();
        $jeemuAddrModel = new DbJeemuAddrModel();
        foreach ($data as $value){
            $redisAddrGeoModel->set($value['x_coord'],$value['y_coord'],$value['c_addr_id']);
            $jeemuAddrModel->set([
                'id'=>$value['c_addr_id'],
                'lng'=>$value['x_coord'],
                'lat'=> $value['y_coord']
            ]);
        }



    }


    public function addrRadiusAction(){
        $redisAddrGeoModel = new RedisAddrGeoModel();
        $data = $redisAddrGeoModel->search('114.021968','22.547851',100);
        $redisAddrModel = new RedisAddrPersonModel();
        $personData = [];
        foreach ($data as $value){
            $temp  = $redisAddrModel->get($value);
            if ($temp){
                $personData[] = $temp;
            }
        }
        jsonResponse($personData);
    }


    public function testAction(){
        $belongsModel = new RedusAddrBelongsModel();
        $data = $belongsModel->getParent(44);
        var_dump($data);
        var_dump(formatBytes());
    }


    public function
}