<?php

use Kata\Homeworks\H04Velocity\Captcha;

class CaptchaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Kata\Homeworks\H04Velocity\Captcha::isNecessary
     * @uses \Kata\Homeworks\H04Velocity\Captcha
     * @dataProvider isCaptcaNecessaryProvider
     */
    public function testIsCaptchaNecessary($necessary)
    {
        $captcha = new Captcha($necessary);
        $this->assertEquals($necessary, $captcha->isNecessary());
    }
    
    /** Data providers */
    
    public function isCaptcaNecessaryProvider()
    {
        return array(
            array(true),
            array(false),
        );
    }
}
