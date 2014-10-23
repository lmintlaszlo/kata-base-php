<?php

use Kata\Homeworks\H04Velocity\Environment;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
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


    public function testDoLoginForm()
    {
        
    }
}
