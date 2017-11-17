<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/14
 * Time: 17:10
 */

namespace Jeemu\Log\Handle;


class File extends AbstractHandler
{

    private $path;
    private $handle;
    public function __construct(string $path = './runtime', string $pathType = 'date')
    {
        $this->initPath($path);
        $this->path = $path;
        $fileName = $this->getPath($pathType);
        $this->handle = fopen($this->path . $fileName, 'a');
        if (!$this->handle) {
            throw new \Exception('打开日志文件出错', -1);
        }
    }

    public function saveLog(string $content): bool
    {
        return (fwrite($this->handle, $content."\r\n") !== false) ? true : false;
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

}