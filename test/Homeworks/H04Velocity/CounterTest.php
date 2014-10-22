<?php

use Kata\Homeworks\H04Velocity\Counter; 
use Kata\Homeworks\H04Velocity\Ip; 


class CounterTest extends \PHPUnit_Framework_TestCase
{
    private $dbHost = 'localhost';
    private $dbName = 'phpunit';
    private $dbUser = 'phpunit';
    private $dbPass = 'phpunit';
    
    private $connection;
    
    protected function setUp()
    {
        $this->connection = new \PDO(
                "mysql:host=$this->dbHost;dbname=$this->dbName",
                $this->dbUser, $this->dbPass
        );
    }
    
    public function testSetToMax()
    {
        $ip = new Ip('1.1.1.5', $this->connection);
        $ip->setToMax();
        
        // A 3-t inkabb konstans legyen
        $this->assertEquals(3, $ip->getCount());
    }
    
    public function testIncrement()
    {
        $ip = new Ip('1.1.1.2', $this->connection);
        $ip->increment();
        
        $this->assertEquals(1, $ip->getCount());
    }
}
