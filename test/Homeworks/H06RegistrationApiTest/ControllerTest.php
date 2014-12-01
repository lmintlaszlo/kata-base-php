<?php

use Kata\Homeworks\H06RegistrationApi\Controller;
use Kata\Homeworks\H06RegistrationApi\Request;
use Kata\Homeworks\H06RegistrationApi\Response;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    private static $connection = null;
    
    private static $dbHost = 'localhost';
    private static $dbName = 'phpunit';
    private static $dbUser = 'phpunit';
    private static $dbPass = 'phpunit';
    
    private $controller;

    public static function setUpBeforeClass()
    {
        self::$connection = new \PDO(
            'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName,
            self::$dbUser, self::$dbPass
        );
    }
    
    public function setUp()
    {
        $response = $this->getResponseMock();
        $userDao  = $this->getUserDaoMock();
        
        $this->controller = new Controller($response, $userDao);
    }
    
    public function testRegistrationSuccessful()
    {
        $request = new Request('Radella Gleeddyecker', 'Ra5Glee', 'Ra5Glee');
        
        // Generator mock
        $generator = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Generator',
            array('generateSaltedHashFromPlain')
        );
        $generator->expects($this->once())->method('generateSaltedHashFromPlain');
        
        // Userbuilder mock
        $userBuilder = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\UserBuilder',
            array('buildFromUsernameAndPass')
        );
        $userBuilder->expects($this->once())->method('buildFromUsernameAndPass');
        
        // Validator mock
        $validator = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Validator',
            array('isValidUsername', 'isValidPassword')
        );        
        $validator->expects($this->once())->method('isValidUsername');
        $validator->expects($this->once())->method('isValidPassword');
        
        $responseJson = $this->controller->registration($generator, $request, $userBuilder, $validator);
        $response = json_decode($responseJson);
        
        var_dump($response);
        
        $this->assertArrayHasKey(Response::PROPERTY_SUCCESS, $response);
        $this->assertEquals(Response::RESULT_CODE_OK, $response[Response::PROPERTY_SUCCESS]);
        
        $this->assertArrayHasKey(Response::PROPERTY_RESULT_CODE, $response);
        $this->assertEquals(Response::RESULT_CODE_OK, $response[Response::PROPERTY_RESULT_CODE]);
        
        $this->assertArrayHasKey(Response::PROPERTY_RESULT_ID, $response);
        $this->assertEquals(1, $response[Response::PROPERTY_RESULT_ID]);
        
        $this->assertArrayHasKey(Response::PROPERTY_RESULT_CODE, $response);
        $this->assertEquals(Response::RESULT_CODE_OK, $response[Response::PROPERTY_RESULT_CODE]);
    }
    
    private function getResponseMock()
    {
        $responseMock = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Response',
            array('setSuccess','setResultCode','setResultId','setMessage','display')
        );
        
//        $responseMock->method('setSuccess')->expects($this->once());
//        $responseMock->method('setResultCode')->expects($this->once());
//        $responseMock->method('setResultId')->expects($this->once());
//        $responseMock->method('setMessage')->expects($this->once());
//        $responseMock->method('display')->expects($this->once());
        
        return $responseMock;
    }
    
    private function getUserDaoMock()
    {
        $userDaoMock = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\UserDao',
            array('store'),
            array(self::$connection)
        );
        
//        $userDaoMock->method('store')->expects($this->once())->willReturn(1);
        
        return $userDaoMock;
    }
    
    private function getAutoRegistrationValidatorMock()
    {
        $validatorMock = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\Validator',
            array('isValidUsername')
        );
        
        $validatorMock->method('isValidUsername')->expects($this->once());
        
        return $validatorMock;
    }
    
    private function getAutoRegistrationUserBuilderMock()
    {
        $userBuilderMock = $this->getMock(
            '\Kata\Homeworks\H06RegistrationApi\UserBuilder',
            array('buildFromUsername')
        );
        
        $userBuilderMock->method('buildFromUsername')->expects($this->once());
        
        return $userBuilderMock;
        
    }
}
