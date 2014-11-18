<?php

use \Kata\Homeworks\H06RegistrationApi\UserBuilder;

class UserBuilderTest extends \PHPUnit_Framework_TestCase
{
    private $userBuilder;
    
    public function setUp()
    {
        $this->userBuilder = new UserBuilder();
    }


    /**
     * @dataProvider buildFromUsernameAndPassProvider
     * @param type $username
     * @param type $password
     */
    public function testBuildFromUsernameAndPassword($username, $password)
    {
        $user = $this->userBuilder->buildFromUsernameAndPass($username, $password);
        
        $this->assertInstanceOf(
            'Kata\Homeworks\H06RegistrationApi\User',
            $user,
            'Generated is not instance of User'
        );
        
        $this->assertEquals(
            $username,
            $user->username,
            'Username is not the same.'
        );
        
        $this->assertEquals(
            $password,
            $user->passwordPlain,
            'Password is not the same.'
        );
        
        $this->assertRegExp(
            '/[a-z0-9]{32}/',
            $user->passwordHash,
            'Passwordhash is not MD5 hash.'
        );
    }
    
    /**
     * @dataProvider buildFromUsernameProvider
     * @param type $username
     */
    public function testBuildFromUsername($username)
    {
        
        $generator = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Generator',
            array('generate')
        );
        
        $generator->expects($this->once())
                ->method('generate')
                ->willReturn(md5(microtime()));
        
        $user = $this->userBuilder->buildFromUsername($username, $generator);
        
        $this->assertInstanceOf(
            'Kata\Homeworks\H06RegistrationApi\User',
            $user,
            'Generated is not instance of User'
        );
        
        $this->assertEquals(
            $username,
            $user->username,
            'Username is not the same.'
        );
        
        $this->assertNotEmpty(
            $user->passwordPlain,
            'Password is not generated.'
        );
        
        $this->assertRegExp(
            '/[a-z0-9]{32}/',
            $user->passwordHash,
            'Passwordhash is not MD5 hash.'
        );
    }
    
    
    /** Data providers */
    
    public function buildFromUsernameAndPassProvider()
    {
        return array(
            array('John Doe',         'joe33'),
            array('Boyce Goodkap',    'boYce5'),
            array('Leila Bimclecker', 'bImLei1758'),
        );
    }
    
    public function buildFromUsernameProvider()
    {        
        return array(
            array('John Doe'),
            array('Boyce Goodkap'),
            array('Leila Bimclecker'),
        );
    }
}
