<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/12/28
 * Time: 15:23
 */

namespace Jeemu;


use Psr\Http\Message\UploadedFileInterface;

class Upload implements UploadedFileInterface
{
    public $host = 'http://res.shiji.com';
    private $uploadPath = APP_PATH.'/upload/file';
    private $filePath;
    private $file;
    private $errorMsg = '';
    private $clientFilename;
    private $clientMediaType;
    private $size;
    private $extension;
    private $key;

    public function __construct($file, string $path = '')
    {

        $this->file = $file;
        if ($this->file['error'] !== 0) {
            $this->codeToMessage($file['error']);
            return;
        }
        if ($path) {
            $this->uploadPath = $path;
        }
        $this->uploadPath;
        $this->filePath = date('/Y/m/d/') . randStr(5);
        if (!is_dir($this->uploadPath . $this->filePath)) {
            createPath($this->uploadPath . $this->filePath, 0644);
        }
        $this->clientFilename = $this->file['name'];
        // $this->clientMediaType = $this->file['type'];
        $this->size = $this->file['size'];
        // var_dump( pathinfo($this->clientFilename));
        $this->extension = pathinfo($this->clientFilename)['extension'];

        $this->getKey();
    }

    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $this->errorMsg = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->errorMsg = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->errorMsg = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->errorMsg = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->errorMsg = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->errorMsg = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $this->errorMsg = "File upload stopped by extension";
                break;

            default:
                $this->errorMsg = "Unknown upload error";
                break;
        }
    }

    public function getClientFilename(): string
    {
        return $this->clientFilename;
        // TODO: Implement getClientFilename() method.
    }

    public function getClientMediaType(): string
    {
        if (empty($this->clientMediaType)) {
            $fInfo = new \finfo(FILEINFO_MIME_TYPE);
            $this->clientMediaType = $fInfo->file($this->file['tmp_name']);
            unset($fInfo);
        }
        return $this->clientMediaType;
        // TODO: Implement getClientMediaType() method.
    }


    public function getError(): string
    {
        return $this->errorMsg;
        // TODO: Implement getError() method.
    }

    public function getSize(): int
    {
        return $this->size;
        // TODO: Implement getSize() method.
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getStream()
    {
        // TODO: Implement getStream() method.
    }

    public function getKey(): string
    {
        if (empty($this->key)) {
            $this->key = md5_file($this->file['tmp_name']);
        }
        return $this->key;
    }

    /**
     *max_size 最大字节数  1k = 1024
     * @param $role
     * @return bool
     */
    public function check($role): bool
    {
        if ($this->file['error'] !== 0) {
            return false;
        }
        if (isset($role['max_size']) && !empty($role['max_size'])) {
            if ($role['max_size'] < $this->getSize()) {
                $this->errorMsg = '上传的文件太大了';
                return false;
            }
        }
        if (isset($role['extension']) && is_array($role['extension'])) {
            if (!in_array($this->getExtension(), $role['extension'])) {
                $this->errorMsg = '只允许上传' . implode(',', $role['extension']) . '格式文件';
                return false;
            }
        }

        if (isset($role['extension']) && is_array($role['extension'])) {
            if (!in_array($this->getExtension(), $role['extension'])) {
                $this->errorMsg = '只允许上传' . implode(',', $role['extension']) . '格式文件';
                return false;
            }
        }
        if (isset($role['mime_type']) && is_array($role['mime_type'])) {
            $fileMimeType = $this->getClientMediaType();
            //$fileMimeType = strstr($fileMimeType,';',true);
            if (!in_array($fileMimeType, $role['mime_type'])) {

                $this->errorMsg = '只允许上传' . implode(',', $role['mime_type']) . '类型文件';
                return false;
            }
        }
        return true;
    }

    public function moveTo($targetPath = ''): string
    {

        if ($this->file['error'] !== 0) {
            return '';
        }

        if (!is_uploaded_file($this->file['tmp_name'])) {
            $this->errorMsg = '非法文件';
            return '';
        }
        $filename = $this->filePath . '/' . uniqid() . '.' . $this->extension;
        if (move_uploaded_file($this->file['tmp_name'], $this->uploadPath . $filename)) {
            // chmod($this->uploadPath.$filename,0444);
            return $this->host . $filename;
        }
        $this->errorMsg = '上传出错';
        return '';
        // TODO: Implement moveTo() method.
    }
}