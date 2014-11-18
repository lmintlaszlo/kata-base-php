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
     * @dataProvider buildFromUsernameAndPass
     * @param type $username
     * @param type $password
     */
    public function testBuildFromUsernameAndPass($username, $password)
    {
        $user = $this->userBuilder->buildFromUsernameAndPass($username, $password);
        
        $this->assertEquals($username, $user->username);
        $this->assertEquals($password, $user->password);
        $this->assertInstanceOf('Kata\Homeworks\H06RegistrationApi\User', $user);
    }
    
    
    /** Data providers */
    public function buildFromUsernameAndPass()
    {
        return array(
            array('John Doe',      'joe33'),
            array('Boyce Goodkap', 'boYce5'),
            array('Leila Bimclecker', 'bImLei1758'),
        );
    }
}
