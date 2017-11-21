<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/11/21
 * Time: 22:21
 */
class CliFile
{
    private $path;
    private $fileName;
    private $fileHandle;

    public function __construct($path,$fileName)
    {
        $this->path = $path;
        $this->createPath();
        $this->fileName = $fileName;
        $this->fileHandle = fopen($this->path.DIRECTORY_SEPARATOR.$this->fileName,'a');
        flock($this->fileHandle,LOCK_EX);
    }

    private function createPath(){
        if (!is_dir($this->path)){
            if (!mkdir($this->path,0755)){
                die('创建目录失败');
            }
        }
    }


    public function saveLog($path,$fileName,$str){
        if ($this->path != $path){
            $this->path = $path;
            $this->createPath();
        }
        if ($this->fileName != $fileName){
            flock($this->fileHandle,LOCK_UN);
            $this->fileName = $fileName;
            $this->fileHandle = fopen($this->path.DIRECTORY_SEPARATOR.$this->fileName,'a');
            flock($this->fileHandle,LOCK_EX);
        }
        return fwrite($this->fileHandle,$str);
    }

    public function __destruct()
    {
        flock($this->fileHandle,LOCK_UN);
        // TODO: Implement __destruct() method.
    }
}