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
use Jeemu\Log\Handle\Mysql;
use Jeemu\Log\Handle\Redis;

class Log
{
    const DEBUG = 'DEBUG';
    const INFO = 'INFO';
    const WARN = 'WARN';
    const ERROR = 'ERROR';
    const FATAL = 'FATAL';

    public static $pathType = [
        'year' => 'year',
        'mouth' => 'mouth',
        'date' => 'date',
        'hour' => 'hour'
    ];

    private $contents;
    private $driveHandle;


    public function __construct(string $driver = 'redis', string $path = './runtime', string $type = 'date', int $timeOur = 0)
    {
        switch ($driver){
            case 'file':
                $this->driveHandle = new File($path . $this->getPath($type));
                break;
            case 'redis':
                $this->driveHandle = new Redis($path . $this->getPath($type),$timeOur);
                break;
            case 'mysql':
                $this->driveHandle = new Mysql(Dispatcher::getInstance()->getMysql('db_log'),$path . $this->getPath($type),$timeOur);
                break;
            default:
                $this->driveHandle = new Redis($path . $this->getPath($type));
                break;
        }

    }

    /*
        public static function getInstance(string $path = './runtime', string $type = 'date')
        {
            if (empty(self::$handle)) {
                self::$handle = new self(new Redis($path.self::getPath($type)));
            }
            return self::$handle;
        }*/


    private function getPath(string $type): string
    {
        switch ($type) {
            case self::$pathType['year']:
                $result = date('/Y') . '.log';
                break;
            case self::$pathType['mouth']:
                $result = date('/Y/m') . '.log';
                break;
            case self::$pathType['date']:
                $result = date('/Y/m/d') . '.log';
                break;
            case self::$pathType['hour']:
                $result = date('/Y/m/d/H') . '.log';
                break;
            default:
                $result = date('/Y/m/d') . '.log';
                break;
        }
        return $result;
    }

    /**
     * 实时写入
     * @param string $content
     * @return bool
     */
    public function write(string $content, string $type = self::INFO): bool
    {
        return $this->driveHandle->saveLog($this->getContent($content, $type));

    }

    /**
     *结束时自动写入
     * @param string $content
     * @return bool
     */
    public function record(string $content, string $type = self::INFO)
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
