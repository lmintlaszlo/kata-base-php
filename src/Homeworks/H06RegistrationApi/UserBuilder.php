<?php

namespace Kata\Homeworks\H06RegistrationApi;

use Kata\Homeworks\H06RegistrationApi\User;

class UserBuilder
{
    const SALT = 'BA234A575689489La7LBA4356bAL67b7aL9BALbaLB';
    
    public function buildFromUsernameAndPass($username, $password)
    {
        $user = new User();
        $user->username      = $username;
        $user->passwordPlain = $password;
        $user->passwordHash  = $this->generateSaltedHash($password);
        
        return $user;
    }
    
    public function buildFromUsername($username, Generator $generator)
    {
        $password = $generator->generate();
        
        $user = new User();
        $user->username      = $username;
        $user->passwordPlain = $password;
        $user->passwordHash  = $this->generateSaltedHash($password);
        
        return $user;
    }
    
    private function generateSaltedHash($password)
    {
        return md5($password.self::SALT);
    }
}
