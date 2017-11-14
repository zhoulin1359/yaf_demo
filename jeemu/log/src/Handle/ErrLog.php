<?php
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

    public static $mouth = 'mouth';

    public static $date = 'date';

    public static $hour = 'hour';

    public function __construct($path,$type)
    {
        $this->path = $path.$this->getPath($type);
    }

    private function getPath(string $type): string
    {
        switch ($type) {
            case self::$mouth:

                $result = date('/Y/m') . '.log';
                break;
            case self::$date:

                $result = date('/Y/m/d') . '.log';
                break;
            case self::$hour:

                $result = date('/Y/m/d/H') . '.log';
                break;
            default:
                $result = date('/Y/m/d') . '.log';
                break;
        }
        return $result;
    }

    public function saveLog(string $content): bool
    {
        // TODO: Implement saveLog() method.
        return error_log($content."\r\n", 3,$this->path);
    }
}