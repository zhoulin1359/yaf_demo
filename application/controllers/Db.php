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
        //var_dump($charArr);
        jsonResponse($charArr);
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

    public function mapperAction(){
        $mapper = new Jeemu\Test\Name();
        $data = $mapper->select(['c_nianhao_id','c_dy','c_dynasty_chn','c_nianhao_chn','c_firstyear','c_lastyear'],['c_nianhao_id[>]'=>0],'nian_hao');
        var_dump($data);
    }

    public function responseAction(){
        //var_dump(Yaf\Response_Abstract::setBody());
      /*  $class = new ReflectionClass('Yaf\Response_Abstract');
        var_dump($class->getMethods());
        var_dump($class->isAbstract());*/
      //var_dump();
        jsonResponse(range(1,20),1,'22');
      //var_dump(Yaf\Response_Abstract);
    }

    public function testAction(){
        $mysql = Jeemu\Dispatcher::getInstance()->getMysql();
        var_export($mysql->select());
    }
}