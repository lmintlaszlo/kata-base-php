<?php

use Kata\Homeworks\H04Velocity\Captcha;

class CaptchaTest extends \PHPUnit_Framework_TestCase
{
    public function testIsCaptchaNeeded()
    {
        $captcha = new Captcha();
        $this->assertTrue($captcha->isCaptchaNeeded());
    }
}
