<?php

use PDO;
use Kata\Homeworks\H04Velocity\Request;
use Kata\Homeworks\H04Velocity\LoginAttempt;

class LoginAttemptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Kata\Homeworks\H04Velocity\LoginAttempt::doLogin
     * @uses \PDO
     * @uses \Kata\Homeworks\H04Velocity\LoginData
     * @uses \Kata\Homeworks\H04Velocity\LoginAttempt
     */
    public function testDoLogin()
    {
        try 
        {
            $dbHost = 'localhost';
            $dbName = 'phpunit';
            $dbUser = 'phpunit';
            $dbPass = 'phpunit';
            
            $connection   = $this->getPdoMock();
            $loginData    = new Request('pityu', 'pityu', '1.1.1.1', '192.168.4.x', 'Hungary');            
            $loginAttempt = new LoginAttempt($loginData, $connection);
            $loginAttempt->isSuccess();
            
            
            $this->assertInstanceOf('\Kata\Homeworks\H04Velocity\LoginAttempt', $loginAttempt);
            
        } catch (Exception $ex) {
            
        }
    }
    
    private function getPdoMock()
    {
        $dbHost = 'localhost';
        $dbName = 'phpunit';
        $dbUser = 'phpunit';
        $dbPass = 'phpunit';
        
        $pdoMock = $this->getMock('PDO', array(), 
                array("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass));
        
        return $pdoMock->expects($this->any())->method('__construct')->will($this->returnSelf());
    }

}
