<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 11:52
 */

namespace Jeemu\Log\Handle;


class Redis extends AbstractHandler
{

    private $redisListKey;

    private $handle;

    public function __construct(string $path)
    {
       // $this->handle = ReddisC
    }

    public function saveLog(string $content): bool
    {

        // TODO: Implement saveLog() method.
    }
}