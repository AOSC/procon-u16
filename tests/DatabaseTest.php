<?php

class DatabaseTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $pdo = Database::connect();
        $this->assertInstanceOf('PDO', $pdo);
        $pdo = null;
    }
}
