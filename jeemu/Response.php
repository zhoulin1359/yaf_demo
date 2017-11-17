<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/17
 * Time: 14:55
 */

namespace Jeemu;


class Response
{
    private $response;
    private $msg;

    public function __construct(Yaf\Response\Http $response)
    {
        $this->response = $response;
        $response->setHeader('Content-Type', 'application/json;charset=utf-8');
    }

    public function addMsg($msg)
    {
        $this->msg[] = $msg;
    }

    private function __destruct()
    {

        // TODO: Implement __destruct() method.
    }
}