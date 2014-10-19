<?php

use Kata\Homeworks\H04Velocity\Captcha;

class CaptchaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Kata\Homeworks\H04Velocity\Captcha::isNecessary
     * @uses \Kata\Homeworks\H04Velocity\Captcha
     */
    public function testIsCaptchaNecessary()
    {
        $condition = $this->getMock('\Kata\Homeworks\H04Velocity\Condition', 
            array('isLimitReached')
        );
        
        $condition->expects($this->once())
                  ->method('isLimitReached')
                  ->willReturn(true);
        
        $captcha = new Captcha($condition);
        
        $this->assertEquals(true,  $captcha->isNecessary());
    }
}
