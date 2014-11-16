<?php

namespace Kata\Homeworks\H04Velocity;

use Kata\Homeworks\H04Velocity\Dao\LoginAttemptDao;

class LoginAttempt extends LoginAttemptDao
{
    const LOGIN_RESULT_SUCCESS   = true;
    const LOGIN_RESULT_UNSUCCESS = false;
    
    private $username;
    private $password;
    
    public function __construct($username, $password, \PDO $connection)
    {
        $this->username   = $username;
        $this->password   = $password;
        
        parent::__construct($connection);
    }
    
    public function isSuccess()
    {
        return ($this->password === $this->getAStoredPropertyByUsername($this->username, 'password'));
    }
    
    public function getCountry()
    {
        return $this->getAStoredPropertyByUsername($this->username, 'country');
    }
}
