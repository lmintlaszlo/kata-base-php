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
            return $this->insert($user);
        }
        
        throw new UserExistsException('Username already exists!');
    }

    private function insert(User $user)
    {
        $sql  = "INSERT INTO `" . $this->tableName . "` (`username`, `password_hash`)" .
                "VALUES (:username, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':password', $user->passwordHash);

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
