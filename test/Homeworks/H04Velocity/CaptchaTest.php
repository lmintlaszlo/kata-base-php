<?php

use Kata\Homeworks\H04Velocity\Captcha;


class CaptchaTest extends \PHPUnit_Framework_TestCase
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
        
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Captcha
     * @uses \Kata\Homeworks\H04Velocity\Captcha
     * @uses \Kata\Homeworks\H04Velocity\Counter
     * @uses \Kata\Homeworks\H04Velocity\Dao
     * @uses \Kata\Homeworks\H04Velocity\Dao\CounterDao
     * @dataProvider isCaptchaNecessaryProvider
     */
    public function testIsCaptchaNecessary($expectedChaptcaState, $ipReturn,
            $ipCountryReturn, $ipRangeReturn, $usernameReturn
    ) {
        // Mockolom a countereket,hogy azt az erteket adjak majd vissza mit varok
        $ip = $this->getMock('\Kata\Homeworks\H04Velocity\Counter\Ip',
                array('isLimitReached'), array('', self::$connection));
        $ip->method('isLimitReached')->willReturn($ipReturn);
        
        $ipCountry = $this->getMock('\Kata\Homeworks\H04Velocity\Counter\IpCountry',
                array('isLimitReached'), array('', self::$connection));
        $ipCountry->method('isLimitReached')->willReturn($ipCountryReturn);
        
        $ipRange = $this->getMock('\Kata\Homeworks\H04Velocity\Counter\IpRange',
                array('isLimitReached'), array('', self::$connection));
        $ipRange->method('isLimitReached')->willReturn($ipRangeReturn);

        $username = $this->getMock('\Kata\Homeworks\H04Velocity\Counter\Username',
                array('isLimitReached'), array('', self::$connection));
        $username->method('isLimitReached')->willReturn($usernameReturn);
        
        $captcha = new Captcha($ip, $ipCountry, $ipRange, $username);
        
        // Osszehasonlitom az ertekeket
        $this->assertEquals($expectedChaptcaState, $captcha->isNecessary());
    }
    
    
    /** Data providers */
    
    public function isCaptchaNecessaryProvider()
    {
        return array(
            array(true, false, false, false, true),
            array(true, false, false, true, true),
            array(true, false, true, false, true),
            array(false, false, false, false, false),
        );
    }
}
