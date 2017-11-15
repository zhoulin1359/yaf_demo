<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/14
 * Time: 20:32
 */

namespace Jeemu\Log\Handle;


class ErrLog extends AbstractHandler
{
    private $path;
    private $fileName;

    public function __construct($path)
    {
        $path = pathinfo($path);
        $this->initPath($path['dirname']);
        $this->path = $path['dirname'];
        $this->fileName = $path['basename'];

    }

    private function initPath($path)
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


    public function saveLog(string $content): bool
    {
        // TODO: Implement saveLog() method.
        return error_log($content . "\r\n", 3, $this->path.'/'.$this->fileName);
    }
}