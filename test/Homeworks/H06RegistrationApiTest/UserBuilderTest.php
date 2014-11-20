<?php

use Kata\Homeworks\H06RegistrationApi\UserBuilder;
use Kata\Homeworks\H06RegistrationApi\Generator;

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
    public function testBuildFromUsernameAndPassword($username, $password) {
        
        $generator = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Generator',
            array('generateSaltedHashFromPlain')
        );
        
        $generator->expects($this->once())
            ->method('generateSaltedHashFromPlain')
            ->willReturn(sha1($password.Generator::SALT)); // sha1 miatt mindegy
        
        $user = $this->userBuilder
            ->buildFromUsernameAndPass(
                $username,
                $password,
                $generator
            );
        
        $this->assertInstanceOf('Kata\Homeworks\H06RegistrationApi\User', $user);        
        $this->assertEquals($username, $user->username);        
        $this->assertEquals($password, $user->passwordPlain);        
        $this->assertInternalType('string', $user->passwordHash);
        $this->assertNotEmpty($user->passwordHash);
    }
    
    /**
     * @dataProvider buildFromUsernameProvider
     * @param type $username
     */
    public function testBuildFromUsername($username)
    {        
        $generator = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Generator',
            array('getPassword', 'getSaltedHash')
        );
        
        $generator->expects($this->once())->method('getPassword')->willReturn('asd12a');
        $generator->expects($this->once())->method('getSaltedHash')->willReturn(sha1('asd12a'.Generator::SALT));
        
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
        
        $this->assertInternalType('string', $user->passwordPlain);
        $this->assertInternalType('string', $user->passwordHash);
        $this->assertNotEmpty($user->passwordPlain);
        $this->assertNotEmpty($user->passwordHash);
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
