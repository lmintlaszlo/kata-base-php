<?php

namespace Kata\Homeworks\H04Velocity;

class LoginAttempt
{
    private $username;
    private $password;
    private $connection;
    
    public function __construct($username, $password, \PDO $connection)
    {
        $this->username   = $username;
        $this->password   = $password;
        $this->connection = $connection;
    }
    
    public function isSuccess()
    {
        return ($this->password === $this->getStoredData('password'));
    }
    
    // Ennek nem itt lenne a helye... talan valami member-ben?
    public function getStoredData($property = '')
    {
        $sql  = "SELECT * FROM login WHERE username = :username";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        
        $stmt->execute();
        $storedData = $stmt->fetch();
        
        if(!empty($property) && isset($storedData[$property]))
        {
            return $storedData[$property];
        }
        
        return $storedData;
    }
    
}
