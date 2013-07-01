<?php

/**
 * Config loader
 * config file "config.json" should exist on project top directory
 */
class Config
{
    private static $data;
    public static function getConfig()
    {
        if (empty(self::$data)) {
            $config = file_get_contents(dirname(__FILE__) . '/../config.json');
            self::$data = json_decode($config);
        }
        return self::$data;
    }
}
