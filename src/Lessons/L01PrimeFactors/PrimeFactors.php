<?php

namespace Kata\Lessons\L01PrimeFactors;

class PrimeFactors {

    public function getPrimeFactors($number)
    {
        $primeFactors = array();
        
        for ($i = 2; $i <= $number; $i++)
        {
            if ($number % $i == 0)
            {
                $primeFactors[] = $i;
                $number = $number / $i;
                $i--;
            }
        }
        
        return $primeFactors;
    }

} 