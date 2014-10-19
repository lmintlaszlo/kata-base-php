<?php

namespace Kata\Lessons\L01Number;

class Number
{
    private $number;

    public function __construct($number)
    {        
        if (!is_numeric($number))
        {
            throw new InvalidNumberException('The given value is not a valid number');
        }
        
        $this->number = $number;
    }

    /**
     * Tells the prime factors of the number.
     *
     * @return array
     */
    public function getPrimeFactors()
    {
        $copiedNumber = $this->number;
        $primeFactors = array();
        
        for ($i = 2; $i <= $copiedNumber; $i++)
        {
            if ($copiedNumber % $i == 0)
            {
                $primeFactors[] = $i;
                $copiedNumber   = $copiedNumber / $i;
                $i--;
            }
        }
        
        return $primeFactors;
    }

    /**
     * Tells how many dividers does the number have.
     *
     * @return int
     */
    public function getNumberOfDividers()
    {
        $numberOfDividers = 1;
        $primeFactors     = $this->getPrimeFactors();
        $countOfPrimes    = array_count_values($primeFactors);

        foreach ($countOfPrimes as $base => $power)
        {
            $numberOfDividers = ($numberOfDividers * ($power+1));
        }

        return $numberOfDividers;
    }
    
    /**
     * Gives the float value of the number.
     * 
     * @return float
     */
    public function getFloatValue()
    {
        return (float)$this->number;
    }
    
    /**
     * Gives the int value of the number.
     * 
     * @return int
     */
    public function getIntValue()
    {
        return (int)$this->number;
    }
    
    /**
     * Gives the number itself.
     * 
     * @return type
     */
    public function getNumber()
    {
        return $this->number;
    }
} 