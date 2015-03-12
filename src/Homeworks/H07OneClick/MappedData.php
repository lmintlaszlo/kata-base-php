<?php

namespace Kata\Homeworks\H07OneClick;

class MappedData
{
    private $method;
    private $properties;
    
    function __construct($method, array $properties)
    {
        $this->method     = $method;
        $this->properties = $properties;
    }

    function getMethod()
    {
        return $this->method;
    }

    function getProperties()
    {
        return $this->properties;
    }
}
