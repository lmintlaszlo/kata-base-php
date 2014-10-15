<?php

namespace Kata\Homeworks\H03Cashier;

class Discount
{
    protected $minimumAmount;
    protected $value;
    
    public function __construct($minimumAmount = null, $value = null)
    {
        $this->minimumAmount = $minimumAmount;
        $this->value         = $value;
    }
    
    public function getMinimumAmount()
    {
        return $this->minimumAmount;
    }
    
    public function getValue()
    {
        return $this->value;
    }
}
