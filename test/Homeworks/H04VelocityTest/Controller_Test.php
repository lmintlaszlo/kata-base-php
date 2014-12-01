<?php

use Kata\Homeworks\H04Velocity\Controller;
use Kata\Homeworks\H04Velocity\LoginAttempt;

class LControllerTest extends \PHPUnit_Framework_TestCase
{
    const LOGIN_NAME     = 'pityu';
    const LOGIN_PASSWORD = 'pityu';
    
    private static $db;

    private static $dbHost = 'localhost';
    private static $dbName = 'phpunit';
    private static $dbUser = 'phpunit';
    private static $dbPass = 'phpunit';
    
    private $loginAttempt;
    private $controller;

    public static function setUpBeforeClass()
    {
        self::$db = new \PDO(
            'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName,
            self::$dbUser, self::$dbPass
        );
    }
    
    public static function tearDownAfterClass()
    {
        self::$db = null;
    }

    public function setUp()
    {
        $this->controller = new Controller();
    }

    /**
     * Testing doLoginFormMethod with a LoginAttempt mock object
     * @dataProvider doLoginProvider
     */
    public function testDoLoginFormUnsuccessfulLogin($expectedResult, $willReturn)
    {
        
        $loginAttemptMock = $this->getMock(
            '\Kata\Homeworks\H04Velocity\LoginAttempt',
            array('isSuccess'),
            array(self::LOGIN_NAME, self::LOGIN_PASSWORD, self::$db)
        );
        
        $loginAttemptMock->method('isSuccess')->willReturn($willReturn);
        
        $this->assertEquals(
            $expectedResult,
            $this->controller->doLoginForm($loginAttemptMock)
        );
    }
    
    
    /** Data providers */
    
    public function doLoginProvider()
    {        
        return array(
            array(Controller::DISPLAY_LOGIN_FORM, LoginAttempt::LOGIN_RESULT_UNSUCCESS),
            array(Controller::DISPLAY_ADMIN_PAGE, LoginAttempt::LOGIN_RESULT_SUCCESS),
        );
    }
}
