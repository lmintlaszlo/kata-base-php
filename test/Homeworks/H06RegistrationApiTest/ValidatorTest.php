<?php

use Kata\Homeworks\H06RegistrationApi\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    const USERNAME_VALID                = 'johndoe1';    
    const USERNAME_TOO_SHORT            = 'doe';
    const USERNAME_CAPITAL_LETTER      = 'JohnDoe';
    const USERNAME_ONLY_CAPITAL_LETTERS = 'JOHNDOE';
    const USERNAME_SPECIAL_CHARACTER   = 'johndoe1_';

    const RESULT_OK    = true;
    const RESULT_ERROR = false;
    
    
    private $validator;
    
    public function setUp()
    {
        $this->validator = new Validator();
    }
    
    /**
     * @dataProvider isValidUsernameProvider
     * 
     * @param bool $expectedResult
     * @param string $username
     */
    public function testIsValidUsername($expectedResult, $username)
    {
        $this->assertEquals($expectedResult, $this->validator->isValidUsername($username));
    }
    
    
    public function testIsValidPassword()
    {
        
    }
    
    /** Data providers */
    
    public function isValidUsernameProvider()
    {
        return array(
            array(self::RESULT_OK, self::USERNAME_VALID),
            array(self::RESULT_ERROR, self::USERNAME_CAPITAL_LETTER),
            array(self::RESULT_ERROR, self::USERNAME_ONLY_CAPITAL_LETTERS),
            array(self::RESULT_ERROR, self::USERNAME_SPECIAL_CHARACTER),
            array(self::RESULT_ERROR, self::USERNAME_TOO_SHORT),
            array(self::RESULT_ERROR, str_repeat(self::USERNAME_VALID, 20)),
        );
    }
}
