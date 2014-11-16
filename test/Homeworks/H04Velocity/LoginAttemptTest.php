<?php

use Kata\Homeworks\H04Velocity\LoginAttempt;
use Kata\Homeworks\H04Velocity\Dao\LoginAttemptDao;

class LoginAttemptTest extends \PHPUnit_Framework_TestCase
{
    private static $connection;
    
    private $request;
    
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
        $loginAttemptDao = new LoginAttemptDao(self::$connection);
        $loginAttemptDao->resetTable();
        
        $this->request = $this->getMock('\Kata\Homeworks\H04Velocity\Request',
            array('getUsername', 'getPassword', 'getCountry'),
            array('pityu', 'pityu', '1.1.1.1', '1.1.1.x', 'hungary')
        );
        
        /** @todo Megkerdezni, hogy hogy lehet olyat, hogy a konstruktor parametereiek egyikevel terjen vissza. */
        $this->request->method('getUsername')->willReturn('pityu');
        $this->request->method('getPassword')->willReturn('pityu');
        $this->request->method('getCountry')->willReturn('hungary');
    }

    /**
     * @covers \Kata\Homeworks\H04Velocity\Dao
     * @covers \Kata\Homeworks\H04Velocity\LoginAttempt
     * @covers \Kata\Homeworks\H04Velocity\Request
     * @covers \Kata\Homeworks\H04Velocity\Dao\LoginAttemptDao
     */
    public function testIsSuccess()
    {
        $loginAttempt = new LoginAttempt(
            $this->request->getUsername(),
            $this->request->getPassword(),
            self::$connection
        );
        
        $this->assertTrue($loginAttempt->isSuccess());
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Dao
     * @covers \Kata\Homeworks\H04Velocity\LoginAttempt
     * @covers \Kata\Homeworks\H04Velocity\Request
     * @covers \Kata\Homeworks\H04Velocity\Dao\LoginAttemptDao
     */
    public function testGetCountry()
    {
        $loginAttempt = new LoginAttempt(
            $this->request->getUsername(),
            $this->request->getPassword(),
            self::$connection
        );
        
        $this->assertEquals($this->request->getCountry(), $loginAttempt->getCountry());
    }
}
