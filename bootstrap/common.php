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
function conf(string $conf,$default = null)
{
    $conf = explode('.', $conf);
    if (empty($conf)) {
        return $default;
    }
    $confArr = Yaf\Registry::get('config');
    foreach ($conf as $value) {
        if (empty($value)) {
            break;
        }
        if (isset($confArr[$value])) {
            $confArr = $confArr[$value];
        } else {
            $confArr = $default;
            break;
        }

    }
    return $confArr;
}

/**
 * json返回
 * @param null $data
 * @param int $status
 * @param string $info
 */
function jsonResponse(array $data = [], int $status = 1, string $info = 'success', Yaf\Response_Abstract $response = null)
{
    /*  var_dump($response);
      var_dump(new Yaf\Response\Http());*/
    if (empty($response)) {
        /* $response = new class() extends Yaf\Response_Abstract
         {
             public $_header = 'Content-Type:application/json;charset=utf-8';
             public $_body = 'Content-Type:application/json;charset=utf-8';
         };*/
        $response = new Yaf\Response\Http();
        //$response = (new BaseController())->getResponse();
    }
    $response->setHeader('Content-Type', 'application/json;charset=utf-8');
    $response->setHeader('Access-Control-Allow-Origin', '*');
    $response->setHeader('Access-Control-Allow-Credentials',true); //允许cookie
    $response->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
    $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT');
    $response->clearBody();
    $callback = Yaf\Dispatcher::getInstance()->getRequest()->getQuery('callback');
    if ($callback) {
        $response->setBody($callback . '(' . json_encode(array('status' => $status, 'info' => $info, 'data' => $data)) . ')');
    } else {
        $response->setBody(json_encode(array('status' => $status, 'info' => $info, 'data' => $data)));
    }

    $response->response();die;
}

class httpResponse extends Yaf\Response_Abstract
{
    public $_header = 'Content-Type:application/json;charset=utf-8';
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


/**
 * 创建目录
 * @param $path
 * @throws Exception
 */
function createPath($path)
{
    if (!is_dir($path)) {
        if (!mkdir($path, 0755, true)) {
            throw new \Exception('创建目录失败', -1);
        }
    } else {
        if (substr(sprintf('%o', fileperms($path)), -4) != '0755') {
            if (!chmod($path, 0755)) {
                throw new \Exception('目录权限错误', -1);
            }
        }
    }

}

/**
 * 获取运行时使用内存
 * @param int $bytes
 * @param int $precision
 * @return string
 */
function formatBytes($bytes = 0, $precision = 2) {
    if (empty($bytes)){
        $bytes = memory_get_peak_usage();
    }
    $units = array("b", "kb", "mb", "gb", "tb");

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . " " . $units[$pow];
}


function mergerEqualArr(array $arr,array $equal,array $merge):array {
    $result = [];
    $md5Arr = [];

}