<?php

/**
 * Database connector
 */
class Database
{
    private static $pdo;
    public static function connect()
    {
        if (empty(self::$pdo)) {
            $config = Config::getConfig();
            $dsn = "mysql:host={$config->dbhost};dbname={$config->dbname}";
            self::$pdo = new PDO($dsn, $config->dbuser, $config->dbpass);
        }
        return self::$pdo;
    }
}
