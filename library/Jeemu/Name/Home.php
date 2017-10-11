<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/10/11
 * Time: 17:37
 */
class Jeemu_Name_Home
{
    private $home = '';

    public function __construct(string $home = null)
    {
        $this->home = $home??$home??'default';
    }

    public function getHome()
    {
        return $this->home;
    }
}