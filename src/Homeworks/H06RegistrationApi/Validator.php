<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Validator
{
    const REGEX_USERNAME = "/[0-9a-z]{4,128}/";
    
    public function isValidUsername($username)
    {
        return preg_match("/^[0-9a-z]{4,128}$/", $username);
    }
}
