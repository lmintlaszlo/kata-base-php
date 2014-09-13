<?php

namespace Kata\Lessons\L01PrimeFactors;

class PrimeFactors {

    public function getPrimeFactors($number)
    {
        $sqrt = sqrt($number);
        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i == 0) {
                return array_merge(array($i), $this->getPrimeFactors($number/$i));
            }
        }
        return array($number);
    }

} 