<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2018/1/4
 * Time: 11:05
 */

namespace Jeemu\Db\Connect;

interface AbstractConn
{
    public function getType(): string;
}