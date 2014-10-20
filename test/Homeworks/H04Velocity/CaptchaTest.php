<?php

use Kata\Homeworks\H04Velocity\Captcha;

class CaptchaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Kata\Homeworks\H04Velocity\Captcha::isNecessary
     * @uses \Kata\Homeworks\H04Velocity\Captcha
     * @dataProvider isCaptchaNecessaryProvider
     */
    public function testIsCaptchaNecessary(
            $expectedChaptcaState,
            $ipReturn,
            $ipCountryReturn,
            $ipRangeReturn,
            $usernameReturn
    ) {
        /**
         * @todo: megkerdezni miert, hal meg ha beirtom, hogy
         *      ->expects($this->once())
         */
        
        $ip = $this->getMock('\Kata\Homeworks\H04Velocity\Ip',
                array('isLimitReached'));
        $ip->method('isLimitReached')->willReturn($ipReturn);
        
        $ipCountry = $this->getMock('\Kata\Homeworks\H04Velocity\IpCountry',
                array('isLimitReached'));
        $ipCountry->method('isLimitReached')->willReturn($ipCountryReturn);
        
        $ipRange = $this->getMock('\Kata\Homeworks\H04Velocity\IpRange',
                array('isLimitReached'));
        $ipRange->method('isLimitReached')->willReturn($ipRangeReturn);

        $username = $this->getMock('\Kata\Homeworks\H04Velocity\Username',
                array('isLimitReached'));
        $username->method('isLimitReached')->willReturn($usernameReturn);
        
        $captcha = new Captcha(
            $ip,
            $ipCountry,
            $ipRange,
            $username
        );
        
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
