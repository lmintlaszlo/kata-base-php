<?php

use Kata\Homeworks\H04Velocity\Counter; 
use Kata\Homeworks\H04Velocity\Ip; 


class CounterTest extends \PHPUnit_Framework_TestCase
{
    private static $db;

    private static $dbHost = 'localhost';
    private static $dbName = 'phpunit';
    private static $dbUser = 'phpunit';
    private static $dbPass = 'phpunit';

    public static function setUpBeforeClass()
    {
        self::$db = new \PDO(
            'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName,
            self::$dbUser, self::$dbPass
        );
    }
    
    public static function tearDownAfterClass()
    {
        self::$db = null;
    }
    
    public function testSetToMax()
    {
        $ip = new Ip('1.1.1.5', self::$db);
        $ip->setToMax();
        
        // A 3 inkabb konstans legyen
        $this->assertEquals(3, $ip->getCount());
    }
    
    public function testIncrement()
    {
        $ip = new Ip('1.1.1.2', self::$db);
        
        $counterBeforeIncrement = $ip->getCount();
        $ip->increment();
        
        $this->assertEquals($counterBeforeIncrement+1, $ip->getCount());
    }
    
    public function testIsLimitReached()
    {
        // Itt inkabb query-vel legyen a set
        $ip = new Ip('1.1.1.5', self::$db);
        $ip->setToMax();
        
        $this->assertTrue($ip->isLimitReached());
    }
}
