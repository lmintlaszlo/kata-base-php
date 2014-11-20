<?php

use Kata\Homeworks\H06RegistrationApi\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    const USERNAME_VALID                = 'johndoe1';    
    const USERNAME_TOO_SHORT            = 'doe';
    const USERNAME_CAPITAL_LETTER       = 'JohnDoe';
    const USERNAME_ONLY_CAPITAL_LETTERS = 'JOHNDOE';
    const USERNAME_SPECIAL_CHARACTER    = 'johndoe1_';
    
    const PASSWORD_VALID             = 'asdasd';
    const PASSWORD_TOO_SHORT         = 'asdas';
    const PASSWORD_INVALID_CHARACTER = 'sasdsdf-';
    const PASSWORD_FOR_MISMATCH      = 'sasd';
    const PASSWORD_FOR_MISMATCH_2    = 'qweerewqqqqqqqqqq';
    
    
    private $validator;
    
    public function setUp()
    {
        $this->validator = new Validator();
    }
    
    public function testIsValidUsername()
    {
        $this->assertTrue($this->validator->isValidUsername(self::USERNAME_VALID));
    }
    
    /**
     * @dataProvider isInvalidUsernameProvider
     * @expectedException \Kata\Homeworks\H06RegistrationApi\InvalidUsernameException
     */
    public function testIsInvalidUsername($username)
    {
        $this->assertEquals(
            $this->validator->isValidUsername($username)
        );
    }
    
    
    public function testIsValidPassword()
    {
        $this->assertTrue(
            $this->validator->isValidPassword(self::PASSWORD_VALID, self::PASSWORD_VALID)
        );
    }
    
    /**
     * @dataProvider isInvalidPasswordProvider
     * @expectedException \Kata\Homeworks\H06RegistrationApi\InvalidPasswordException
     */
    public function testIsInvalidPassword($password, $passwordConfirm)
    {
        $this->validator->isValidPassword($password, $passwordConfirm);
    }
    
    /**
     * @dataProvider isInvalidPasswordConfirmProvider
     * @expectedException \Kata\Homeworks\H06RegistrationApi\InvalidPasswordConfirmException
     */
    public function testIsInvalidPasswordConfirm($password, $passwordConfirm)
    {
        $this->validator->isValidPassword($password, $passwordConfirm);
    }
    

    /** Data providers */
    
    public function isInvalidUsernameProvider()
    {
        return array(
            array(self::USERNAME_CAPITAL_LETTER),
            array(self::USERNAME_ONLY_CAPITAL_LETTERS),
            array(self::USERNAME_SPECIAL_CHARACTER),
            array(self::USERNAME_TOO_SHORT),
            array(str_repeat(self::USERNAME_VALID, 20)),
        );
    }
    
    public function isInvalidPasswordProvider()
    {
        return array(
            array(self::PASSWORD_INVALID_CHARACTER, self::PASSWORD_FOR_MISMATCH),
            array(self::PASSWORD_TOO_SHORT, self::PASSWORD_TOO_SHORT),
        );
    }
    
    public function isInvalidPasswordConfirmProvider()
    {
        return array(
            array(self::PASSWORD_VALID, self::PASSWORD_FOR_MISMATCH),
            array(self::PASSWORD_VALID, self::PASSWORD_FOR_MISMATCH_2),
        );
    }
}
