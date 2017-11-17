<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/14
 * Time: 14:28
 */

namespace Jeemu\Log\Handle;

abstract class AbstractHandler
{
    protected $driverHandle;

    abstract public function saveLog(string $content): bool;

}