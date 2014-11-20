<?php

use Kata\Homeworks\H06RegistrationApi\User;
use Kata\Homeworks\H06RegistrationApi\UserDao;

class UserDaoTest extends \PHPUnit_Framework_TestCase
{
    const TEST_USERNAME = 'John Doe';
    const TEST_PASSWORD = 'asdf1234';
    
    private static $connection;
    
    private $userDao;
    
    /**
     * Megnyitom a mysql kapcsolatot, amit a tesz majd vegig hasznalni fog.
     */
    public static function setUpBeforeClass()
    {
        try
        {
            self::$connection = new \PDO('mysql:host=localhost;dbname=phpunit',
                'phpunit', 'phpunit'
            );            
        }
        catch (Exception $e)
        {
            /** @todo: Megkerdezni, hogy ilyenkor mit lehet tenni? */
        }
    }
    
    /**
     * Lezarom a kapcsolatot.
     */
    public static function teardownAfterClass()
    {
        self::$connection = null;
    }
    
    
    public function setUp()
    {
        $this->userDao = new UserDao(self::$connection);
        self::$connection->query("TRUNCATE TABLE `" . $this->userDao->tableName . "`");
    }
    
    public function testStore()
    {
        $user = new User();
        $user->username      = self::TEST_USERNAME;
        $user->passwordPlain = self::TEST_PASSWORD;
        $user->passwordHash  = sha1($user->passwordPlain);
        
        $storeResult = $this->userDao->store($user);
        
        $selectedUser = $this->directSelectByUsername($user);

        $this->assertTrue($storeResult > 0);
        $this->assertEquals($user->passwordHash, $selectedUser->password_hash);
    }
    
    /**
     * @expectedException \Kata\Homeworks\H06RegistrationApi\UserExistsException
     */
    public function testStoreWithNotUniqUsername()
    {
        $user = new User();
        $user->username      = self::TEST_USERNAME;
        $user->passwordPlain = self::TEST_PASSWORD;
        $user->passwordHash  = sha1($user->passwordPlain);
        
        $this->directInsert($user);

        $this->userDao->store($user);
    }

    public function directSelectByUsername(User $user)
    {
        $sth = self::$connection->prepare(
            "SELECT * FROM `" . $this->userDao->tableName . "`" .
            " WHERE `username` = :username"
        );
	$sth->execute(array(':username' => $user->username));
	
        return $sth->fetch(PDO::FETCH_OBJ);
        
    }
    
    private function directInsert(User $user)
    {
        $insertStmnt = self::$connection->prepare(
            "INSERT INTO `" . $this->userDao->tableName . "` (`username`, `password_hash`)" .
            "VALUES (:username, :passwordHash)"
        );
        
        $insertStmnt->execute(array(
            ':username'     => $user->username,
            ':passwordHash' => $user->passwordHash,
        ));
        
        return self::$connection->lastInsertId();
    }
}
