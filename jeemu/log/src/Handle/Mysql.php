<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/11/17
 * Time: 15:50
 */

namespace Jeemu\Log\Handle;


use Medoo\Medoo;

class Mysql extends AbstractHandler
{

    private $logNmme;
    private $timeOut = 86400 * 30;
    private $tableName = 'test_log';

    public function __construct(Medoo $medoo, string $path, int $timeOut)
    {
        $this->driverHandle = $medoo;
        $exist = $this->driverHandle->query('show tables like ' . $this->tableName . '')->fetchAll();
        if (empty($exist)) {
            $this->driverHandle->exec('CREATE TABLE `' . $this->tableName . '` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT \'\' ,
`info`  text NOT NULL ,
`expiration_time`  int(11) NOT NULL DEFAULT 0 COMMENT \'过期时间\' ,
`insert_time`  int(11) NOT NULL DEFAULT 0 COMMENT \'插入时间\' ,
PRIMARY KEY (`id`),
INDEX `insert_time_normal` (`insert_time`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8
;')/*->execute()*/
            ;
        }
        if ($timeOut) {
            $this->timeOut = $timeOut;
        }
        $this->logNmme = $path;
    }


    public function saveLog(string $content): bool
    {
        // TODO: Implement saveLog() method.
        ($this->driverHandle->insert($this->tableName, ['name' => $this->logNmme, 'info' => $content, 'expiration_time' => time() + $this->timeOut, 'insert_time' => time()]));
        return !empty($this->driverHandle->id()) ? true : false;
    }
}