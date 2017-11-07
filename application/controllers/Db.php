<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/26
 * Time: 23:37
 */
class DbController extends Yaf\Controller_Abstract
{
    public function indexAction()
    {
        ///jsonResponse($this->getResponse(),(new NianHaoModel())->table());
        $data = (new NianHaoModel())->table();
        $charArr = [];
        $charLenArr = [];
        $charLenStrArr = [];
        foreach ($data as $value) {
            $strLen = mb_strlen($value['c_nianhao_chn']);
            if (isset($charLenArr[$strLen])) {
                $charLenArr[$strLen]++;
            } else {
                $charLenArr[$strLen] = 1;
            }
            $charLenStrArr[$strLen][] = $value['c_nianhao_chn'];
            //var_dump(mb_substr($value['c_nianhao_chn'],1,1));die();
            for ($i = 0; $i < $strLen; $i++) {
                $charArr[] = mb_substr($value['c_nianhao_chn'],$i,1);
            }

        }

        $charNewArr = [];
        foreach ($charArr as $value){
            foreach ($charNewArr as $index=>$item){
                if ($item['char'] == $value){
                    $charNewArr[$index]['count']++;
                }
            }
        }

       // var_dump($charArr);
        $redis = new RedisCacheModel();
        var_dump($redis->setCache(1,2));
        //jsonResponse($this->getResponse(), [$charLenArr, $charLenStrArr]);
    }

    public function redisAction(){
        //(new RedisModel())->setKeyIncr();
        $cache = new RedisCacheModel();
        var_dump($cache->setCache('1',[23466]));
        var_dump($cache->getCache('1'));
    }

    public function redisAddAction(){
        $cache = new RedisModel();
        $cache -> autoInc();
    }
}