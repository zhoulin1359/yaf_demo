<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/17
 * Time: 19:18
 */

namespace Jeemu\Cache;


class File extends AbstractDriver
{
    private $path;

    public function __construct($path = './runtime/cache')
    {
        createPath($path);
        $this->path = $path;
    }


    private function getPath(string $key): string
    {
        return $this->path . DIRECTORY_SEPARATOR . $key[0] . DIRECTORY_SEPARATOR . $key[1] . DIRECTORY_SEPARATOR . $key[2] . DIRECTORY_SEPARATOR;
    }

    public function set(string $key, $value, int $ttl = 0): bool
    {
        $path = $this->getPath($key);
        createPath($path);
        if ($ttl) {
            $this->ttl = $ttl;
        }
        $valueArr = ['value' => $value, 'expire_time' => time() + $this->ttl];
        return empty(file_put_contents($path . $key, serialize($valueArr))) ? false : true;
        // TODO: Implement set() method.

    }

    public function get(string $key)
    {
        $fileName = $this->getPath($key) . $key;
        if (file_exists($fileName)) {
            $value = file_get_contents($this->getPath($key) . $key);
            if ($value) {
                $value = unserialize($value);
                if (time() > $value['expire_time']) {
                    $this->delete($key);
                    return '';
                }
                return $value['value'];
            }
            return '';
        }
        return '';
        // TODO: Implement get() method.
    }

    public function delete(string $key): bool
    {
        $fileName = $this->getPath($key) . $key;
        if (file_exists($fileName)) {
            unlink($fileName);
        }
        return true;
        // TODO: Implement delete() method.
    }


    public function has(string $key):bool
    {
        return file_exists($this->getPath($key) . $key);
        // TODO: Implement has() method.
    }

    public function clear():bool
    {
       $this->clearPath($this->path);
        return true;
        //return rmdir($this->path);
        // TODO: Implement clear() method.
    }

    private function clearPath(string $path){
        $dir = opendir($path);
        while (false !== ($file = readdir($dir))) {
            if ($file != '.' && $file != '..') {
                $full = $path . '/' . $file;
                if (is_dir($full)) {
                    $this->clearPath($full);
                } else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($path);
    }
}