<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Request
{
    public $username;
    public $password;
    public $passwordConfirm;
    
    function __construct($username, $password, $passwordConfirm)
    {
        $this->username = $username;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
    }

}
