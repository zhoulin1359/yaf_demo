<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/15
 * Time: 15:27
 */

namespace Jeemu\Test;


class Collection implements \Iterator
{
    protected $mapper;
    protected $total = 0;
    protected $raw = array();

    private $result;
    private $pointer = 0;
    private $objects = array();

    public function __construct(array $raw = [], Mapper $mapper)
    {
        $this->raw = $raw;
        $this->total = count($raw);
        $this->mapper = $mapper;
    }

    public function notifyAccess(){

    }

    private function getRow(int $pointer)
    {
        if (isset($this->objects[$pointer])) {
            return $this->objects[$pointer];
        }
        if (isset($this->raw[$pointer])) {
            return $this->objects[$pointer] = $this->mapper->createObj($this->raw[$pointer]);
        }
        return null;
    }

    public function rewind()
    {
        $this->pointer = 0;
        // TODO: Implement rewind() method.
    }

    public function current()
    {
        return $this->getRow($this->pointer);
        // TODO: Implement current() method.
    }


    public function key()
    {
        return $this->pointer;
        // TODO: Implement key() method.
    }


    public function next()
    {
        $result = $this->getRow($this->pointer);
        if ($result) {
            $this->pointer++;
        }
        return $result;
        // TODO: Implement next() method.
    }


    public function valid()
    {
        return !is_null($this->current());
        // TODO: Implement valid() method.
    }
}