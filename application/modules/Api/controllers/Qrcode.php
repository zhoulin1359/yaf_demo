<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/3/14
 * Time: 10:45
 * Email: zhoulin@mapgoo.net
 */
class QrcodeController extends InitController
{
    public function createAction(){
        $data = (array(
            'url' =>'https://www.qianfu-edu.com/',
            'icon'=>'/dist/images/default.png',
            'text'=>'哈哈哈',
            'num'=>10000
        ));
        $mysqlConn = MysqlJeemuQrcodeModel::getInstance();
        if ($qrID = $mysqlConn ->insertQrcodeData($data)) {
            $redisConn = RedisConnModel::getInstance();
            for ($i = 0; $i < 10000; $i++) {
                $data = json_encode(array(
                    'url' => 'https://www.qianfu-edu.com/',
                    'icon'=>'/dist/images/default.png',
                    'text' => '哈哈哈',
                    'num'  => $i+1
                ));
                $redisConn ->sadd('qrcode_set_'.$qrID,$data);
            }
        }
        var_dump($data);
    }
    
    public function showQrcodeAction(){
        $mysqlConn = MysqlJeemuQrcodeModel::getInstance();
        $qrID = $mysqlConn->getQrcodeID();
       // var_dump($qrID);

        $redisConn = RedisConnModel::getInstance();
        while (true){
            $randQrcode = json_decode($redisConn->srandmember('qrcode_set_' . $qrID[0]),true);
            if (isset($qrcode)){
                $isExsist = false;
                foreach ($qrcode as $value){
                    if ($value['num'] === $randQrcode['num']){
                        $isExsist = true;
                        break;
                    }
                }
                if ($isExsist == false){

                    $qrcode[] = $randQrcode;
                }

            }else{
                $qrcode[] = $randQrcode;
            }

            if (count($qrcode) >= 10){
                break;
            }
            //break;
        }

        /*$qrcode[] = $redisConn->srandmember('qrcode_set_' . $qrID[0]);*/
        //var_dump($qrcode);
        $key = Bootstrap::randStr(8);
       // var_dump($key);
        $xcrypt = new Aes_Xcrypt($key,'ecb','off');
        //$xcrypt ->getIV();
        $iconArr = ['/dist/images/default.png','/dist/images/me.png','/dist/images/qrcode.png','/dist/images/Wood.png'];
        foreach ($qrcode as $key => $value){
            $qrcodeData['icon'] = $iconArr[array_rand($iconArr)];//$value['icon'];
            $qrcodeData['text'] = $value['text'];
            $qrcodeData['info'] = 'http://192.168.100.178:8090/page/feedback.html';//base64_encode($xcrypt->encrypt(json_encode($value)));
            $qrcode[$key] = $qrcodeData;
        }
        //var_dump($qrcode);
        Bootstrap::jsonResponse($qrcode);
    }

    public function decrypeAction(){
        $key = '6B6d0JKW';
        $xcrypt = new Aes_Xcrypt($key,'ecb','off');
        $str = base64_decode($this->getRequest()->getParam('info'));
        var_dump($str);
        var_dump($str = $xcrypt->decrypt($str));

        $redisConn = RedisConnModel::getInstance();
        $redisConn -> srem('qrcode_set_5',$str);
    }
    
    public function testAction(){
        ignore_user_abort(1);
        ob_end_clean();
        while (true){
            error_log(time()."\n",3,'./log.log');
            echo time()."\n";
            flush();
            sleep(1);
        }
    }
}