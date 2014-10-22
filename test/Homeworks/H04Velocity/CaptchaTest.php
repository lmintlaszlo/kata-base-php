<?php

use Kata\Homeworks\H04Velocity\Captcha;


class CaptchaTest extends \PHPUnit_Framework_TestCase
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
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Captcha::isNecessary
     * @uses \Kata\Homeworks\H04Velocity\Captcha
     * @uses \Kata\Homeworks\H04Velocity\Counter
     * @dataProvider isCaptchaNecessaryProvider
     */
    public function testIsCaptchaNecessary($expectedChaptcaState, $ipReturn,
            $ipCountryReturn, $ipRangeReturn, $usernameReturn
    ) {
        // Mockolom a countereket,hogy azt az erteket adjak majd vissza mit varok
        $ip = $this->getMock('\Kata\Homeworks\H04Velocity\Ip',
                array('isLimitReached'), array('', $this->connection));
        $ip->method('isLimitReached')->willReturn($ipReturn);
        
        $ipCountry = $this->getMock('\Kata\Homeworks\H04Velocity\IpCountry',
                array('isLimitReached'), array('', $this->connection));
        $ipCountry->method('isLimitReached')->willReturn($ipCountryReturn);
        
        $ipRange = $this->getMock('\Kata\Homeworks\H04Velocity\IpRange',
                array('isLimitReached'), array('', $this->connection));
        $ipRange->method('isLimitReached')->willReturn($ipRangeReturn);

        $username = $this->getMock('\Kata\Homeworks\H04Velocity\Username',
                array('isLimitReached'), array('', $this->connection));
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
