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
function conf(string $conf, $default = null)
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
function jsonResponse(array $data = [], int $status = 1, string $msg = 'success', Yaf\Response_Abstract $response = null): bool
{
    if (empty($response)) {
        $response = new Yaf\Response\Http();
    }
    $obj = \Jeemu\Dispatcher::getInstance()->getResponse($response);
    $obj->setData($data);
    $obj->setStatus($status);
    $obj->setMsg($msg);
    return true;
}


function getRequestQuery(string $name, $default = null)
{
    $request = Jeemu\Dispatcher::getInstance()->getRequest();
    return $request->getQuery($name, $default);
}

function getRequestPost(string $name, $default = null)
{
    $request = Jeemu\Dispatcher::getInstance()->getRequest();
    return $request->getPost($name, $default);
}

function getRequestBody(string $name, $default = null)
{
    $request = Jeemu\Dispatcher::getInstance()->getRequest();
    return $request->getBody($name, $default);
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
function createPath($path, $mode = 0755)
{
    if (!is_dir($path)) {
        if (!mkdir($path, $mode, true)) {
            throw new \Exception('创建目录失败', -1);
        }
    } else {
        if (substr(sprintf('%o', fileperms($path)), -4) != '0755') {
            if (!chmod($path, $mode)) {
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
function formatBytes($bytes = 0, $precision = 2)
{
    if (empty($bytes)) {
        $bytes = memory_get_peak_usage();
    }
    $units = array("b", "kb", "mb", "gb", "tb");

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . " " . $units[$pow];
}

/**
 * 发送https请求
 * @param $url
 * @return mixed
 */
function curlHttpsGet($url, $timeOut = 10)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}