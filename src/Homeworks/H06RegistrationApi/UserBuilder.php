<?php

namespace Kata\Homeworks\H06RegistrationApi;

use Kata\Homeworks\H06RegistrationApi\User;

class UserBuilder
{    
    public function buildFromUsernameAndPass($username, $password, Generator $generator)
    {
        $user = new User();
        $user->username      = $username;
        $user->passwordPlain = $password;
        $user->passwordHash  = $generator->generateSaltedHashFromPlain($password);
        
        return $user;
    }
    
    public function buildFromUsername($username, Generator $generator)
    {   
        $user = new User();
        $user->username      = $username;
        $user->passwordPlain = $generator->getPassword();
        $user->passwordHash  = $generator->getSaltedHash();
        
        return $user;
    }
}
