<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/14
 * Time: 11:44
 */

namespace Jeemu;

use Jeemu\Log\Handle\AbstractHandler;
use Jeemu\Log\Handle\ErrLog;
use Jeemu\Log\Handle\File;

class Log
{
    private $contents;
    private static $handle;
    private $driveHandle;
    public static $type = ['DEBUG' => 'DEBUG', 'INFO' => 'INFO', 'WARN' => 'WARN', 'ERROR' => 'ERROR', 'FATAL' => 'FATAL'];

    private function __construct(AbstractHandler $logDriver)
    {
        $this->driveHandle = $logDriver;
    }


    public static function getInstance(string $path = './runtime', string $type = 'date')
    {
        if (empty(self::$handle)) {
            self::$handle = new self(new ErrLog($path, $type));
        }
        return self::$handle;
    }


    /**
     * 实时写入
     * @param string $content
     * @return bool
     */
    public function write(string $content, string $type = 'INFO'): bool
    {
        return $this->driveHandle->saveLog($this->getContent($content, $type));

    }

    /**
     *结束时自动写入
     * @param string $content
     * @return bool
     */
    public function record(string $content, string $type = 'INFO')
    {
        $this->contents[] = $this->getContent($content, $type);

    }

    private function getContent(string $content, string $type)
    {
        // 获取基本信息
        if (isset($_SERVER['HTTP_HOST'])) {
            $current_uri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        } else {
            $current_uri = "cmd:" . implode(' ', $_SERVER['argv']);
        }

        $date = date('Y/m/d H:i:s');

        return $type . '|' . $date . '|' . $current_uri . '|' . $content;
    }

    public function __destruct()
    {
        if (!empty($this->contents)) {
            $this->driveHandle->saveLog(implode("\r\n", $this->contents));
        }
        // TODO: Implement __destruct() method.
    }
}
