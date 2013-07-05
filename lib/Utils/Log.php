<?php
namespace Utils;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Config;

class Log
{
    /**
     * @return Monolog\Logger
     */
    public static function getLogger()
    {
        $config = Config::getConfig();
        $log = new Logger('procon_u16');
        $level = strtoupper($config->logging_level);
        $log->pushHandler(new StreamHandler($config->logging_path, constant("\Monolog\Logger::$level")));
        return $log;
    }
}
