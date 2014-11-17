<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Validator
{
    const REGEX_USERNAME = "/^[0-9a-z]{4,128}$/";
    const REGEX_PASSWORD = "/[0-9a-zA-Z_]{6,}/";   //Mindnefele specialis bizbasz
    
    public function isValidUsername($username)
    {
        return preg_match(self::REGEX_USERNAME, $username);
    }
    
    public function isValidPassword($password, $passwordConfirm)
    {
        $passwordsMatch = ($password == $passwordConfirm);
        $passwordsValid = preg_match(self::REGEX_PASSWORD, $password);
        
        return ($passwordsMatch && $passwordsValid);
    }
}
