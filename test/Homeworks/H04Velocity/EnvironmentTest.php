<?php

use Kata\Homeworks\H04Velocity\Environment;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    private $dbHost = 'localhost';
    private $dbName = 'phpunit';
    private $dbUser = 'phpunit';
    private $dbPass = 'phpunit';
    
    private $connection;
    
    public function __construct()
    {
        $this->connection = new \PDO(
                "mysql:host=$this->dbHost;dbname=$this->dbName",
                $this->dbUser, $this->dbPass
        );
    }

    public function testDoLoginForm()
    {
        
    }
}
