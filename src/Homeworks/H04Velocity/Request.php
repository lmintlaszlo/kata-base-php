<?php

namespace Kata\Homeworks\H04Velocity;

class Request
{
    private $username;
    private $password;
    private $ip;
    private $ipRange;
    private $ipCountry;
    
    function __construct($username, $password, $ip, $ipRange, $ipCountry)
    {
        $this->username  = $username;
        $this->password  = $password;
        $this->ip        = $ip;
        $this->ipRange   = $ipRange;
        $this->ipCountry = $ipCountry;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getIp()
    {
        return $this->ip;
    }

    function getIpRange()
    {
        return $this->ipRange;
    }

    function getIpCountry()
    {
        return $this->ipCountry;
    }


    
}
