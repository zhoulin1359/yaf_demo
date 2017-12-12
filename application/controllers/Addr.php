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
        $model = new DbJeemuAddrModel();
        $data = $model->get();
        //$url =116.481499,39.990475';
        foreach ($data as $value){
            $url = 'http://restapi.amap.com/v3/assistant/coordinate/convert?coordsys=gps&output=json&key=057cb3ea56d233f6edcfa4b3f394d91a&locations='.$value['lng'].','.$value['lat'];
           // var_dump($url);die;
            $result = file_get_contents($url);
            $result = json_decode($result,true);
            //var_dump($result);die;
            if (isset($result['status']) && $result['status'] == 1){
                $arr = explode(',',$result['locations']);
                $model->updateById(['gaode_lng'=>$arr[0],'gaode_lat'=>$arr[1]],$value['id']);
            }else{
                var_dump($result);die;
            }
        }
        var_dump($data);
    }


    public function addrAction(){
        $request['min_lng'] = \Jeemu\Dispatcher::getInstance()->getRequest()->getQuery('min_lng',0.0);
        $request['max_lng'] = \Jeemu\Dispatcher::getInstance()->getRequest()->getQuery('max_lng',0.0);
        $request['min_lat'] = \Jeemu\Dispatcher::getInstance()->getRequest()->getQuery('min_lat',0.0);
        $request['max_lat'] = \Jeemu\Dispatcher::getInstance()->getRequest()->getQuery('max_lat',0.0);
        $model = new DbJeemuAddrModel();
        jsonResponse($model->getByLngAntLat($request));
    }
}