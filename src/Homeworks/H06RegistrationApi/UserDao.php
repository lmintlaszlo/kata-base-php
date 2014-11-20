<?php

namespace Kata\Homeworks\H06RegistrationApi;

use Kata\Homeworks\H04Velocity\Dao;
use Kata\Homeworks\H06RegistrationApi\UserExistsException;

class UserDao extends Dao
{
    public $tableName = 'registration_api_users';

    public function store(User $user)
    {
        if ($this->usernameWillBeUniq($user->username))
        {
            if (!$this->insert($user->username, $user->passwordHash))
            {
                return 0;
            }
            
            return $this->connection->lastInsertId();
        }
        
        throw new UserExistsException('Username already exists!');
    }

    private function insert($username, $passwordHash)
    {
        $sql  = "INSERT INTO `" . $this->tableName . "` (`username`, `password_hash`)" .
                "VALUES (:username, :passwordHash)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':passwordHash', $passwordHash);

        return $stmt->execute();
    }
    
    private function usernameWillBeUniq($username)
    {
        $sth = $this->connection->prepare(
            "SELECT count(*) as `sum`" .
            "FROM `registration_api_users` " .
            "WHERE `username` = :username"
        );
	$sth->execute(array(':username' => $username));
	
        $result = $sth->fetch();

        return ($result['sum'] == 0);
    }
}
