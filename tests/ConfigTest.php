<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return string, path of `config.json`
     */
    public function getConfigPath()
    {
        return dirname(__FILE__) . '/../config.json';
    }

    /**
     * test if `config.json` exists on top directory
     */
    public function testConfigExists()
    {
        $config_path = $this->getConfigPath();
        $exists = file_exists($config_path);
        $this->assertTrue($exists);
        $config = file_get_contents($config_path);
        return json_decode($config);
    }

    /**
     * @depends testConfigExists
     */
    public function testDatabaseFields($config2)
    {
        $config = Config::getConfig();

        $this->assertObjectHasAttribute('dbhost', $config);
        $this->assertObjectHasAttribute('dbname', $config);
        $this->assertObjectHasAttribute('dbpass', $config);
        $this->assertObjectHasAttribute('dbuser', $config);

        $this->assertEquals($config->dbhost, $config2->dbhost);
        $this->assertEquals($config->dbname, $config2->dbname);
        $this->assertEquals($config->dbpass, $config2->dbpass);
        $this->assertEquals($config->dbuser, $config2->dbuser);
    }
}
