<?php

use Kata\Homeworks\H04Velocity\Counter\Ip;
use Kata\Homeworks\H04Velocity\Dao\CounterDao;


class CounterTest extends \PHPUnit_Framework_TestCase
{
    private static $connection;
    
    /**
     * Megnyitom a mysql kapcsolatot, amit a tesz majd vegig hasznalni fog.
     */
    public static function setUpBeforeClass()
    {
        try
        {
            self::$connection = new \PDO('mysql:host=localhost;dbname=phpunit',
                'phpunit', 'phpunit'
            );            
        }
        catch (Exception $e)
        {
            /** @todo: Megkerdezni, hogy ilyenkor mit lehet tenni? */
        }
    }
    
    /**
     * Lezarom a kapcsolatot.
     */
    public static function teardownAfterClass()
    {
        self::$connection = null;
    }
    
    /**
     * Minden teszt elott elokeszitem a tablat ami a bejelentkezesi adatokat 
     * tartalmazza, es osszeallitok egy mock request objektumot.
     */
    public function setUp()
    {
        /** @todo Gecire nem fasza, hogy itt be kell adni a TABLE_NAME-t! */
        $counterDao = new CounterDao(self::$connection, 'ip');
        $counterDao->resetTable();
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Counter
     * @covers \Kata\Homeworks\H04Velocity\Dao
     * @covers \Kata\Homeworks\H04Velocity\Dao\CounterDao
     */
    public function testSetToLimit()
    {
        $ip = new Ip('1.1.1.5', self::$connection);
        $ip->setToLimit();
        
        // A 3 inkabb konstans legyen
        $this->assertEquals(3, $ip->getCount());
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Counter
     * @covers \Kata\Homeworks\H04Velocity\Dao
     * @covers \Kata\Homeworks\H04Velocity\Dao\CounterDao
     */
    public function testIncrement()
    {
        $ip = new Ip('1.1.1.2', self::$connection);
        
        $ip->increment();
        $ip->increment();
        $ip->increment();
        $ip->increment();
        $ip->increment();
        
        $this->assertEquals(5, $ip->getCount());
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Counter
     * @covers \Kata\Homeworks\H04Velocity\Dao
     * @covers \Kata\Homeworks\H04Velocity\Dao\CounterDao
     */
    public function testIsLimitReached()
    {
        // Itt inkabb query-vel legyen a set
        $ip = new Ip('1.1.1.1', self::$connection);
        $ip->setToLimit();
        
        $this->assertTrue($ip->isLimitReached());
    }
}
