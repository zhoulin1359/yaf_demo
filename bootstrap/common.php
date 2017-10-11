<?php
/**
 * 自定义方法
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/11
 * Time: 16:13
 */

/**
 * 从对象注册表读取配置项
 * @param $conf  以.分割的配置项
 * @return mixed 配置项
 */
function conf(string $conf)
{
    $conf = explode('.', $conf);
    $confArr = Yaf_Registry::get('config');
    foreach ($conf as $value) {
        if (empty($value)) {
            break;
        }
        $confArr = $confArr[$value];
    }
    return $confArr;
}

/**
 * json返回
 * @param null $data
 * @param int $status
 * @param string $info
 */
function jsonResponse(array $data = [], int $status = 0, string $info = 'success')
{
    //header('Content-Type:application/json; charset=utf-8');
   /* Yaf\Response_Abstract::setHeader('Content-Type:application/json; charset=utf-8');
    Yaf\Response_Abstract::setBody(json_encode(array('status' => $status, 'info' => $info, 'data' => $data)));
    Yaf\Response_Abstract::response();*/
    //echo(json_encode(array('status' => $status, 'info' => $info, 'data' => $data)));
    //return null;
    $response = new Yaf_Response_Http();
    $response -> setHeader('Content-Type','application/json;charset=utf-8');
    $response -> setBody(json_encode(array('status' => $status, 'info' => $info, 'data' => $data)));
}

/**
 * 随机字符串
 * @param int $len
 * @return null|string
 */
function randStr(int $len = 8)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    for ($i = 0; $i < $len; $i++) {
        $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }

    return $str;
}