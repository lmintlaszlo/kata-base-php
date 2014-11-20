<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Validator
{
    const REGEX_USERNAME = "/^[0-9a-z]{4,128}$/";
    const REGEX_PASSWORD = "/^[0-9a-zA-Z_]{6,}$/";   //Mindnefele specialis bizbasz
    
    public function isValidUsername($username)
    {
        if(!preg_match(self::REGEX_USERNAME, $username))
        {
            throw new InvalidUsernameException('Invalid username format.');
        }
        
        return true;
    }
    
    public function isValidPassword($password, $passwordConfirm)
    {
        if(!preg_match(self::REGEX_PASSWORD, $password))
        {
            throw new InvalidPasswordException('Invalid password!');
        }
        
        if($password !== $passwordConfirm)
        {
            throw new InvalidPasswordConfirmException('Invalid passwrd confirmation!');
        }
        
        return true;
    }
}
