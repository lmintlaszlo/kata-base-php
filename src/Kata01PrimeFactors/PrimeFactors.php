<?php

namespace Kata\Kata01PrimeFactors;

class PrimeFactors {

    public function getPrimeFactor($number)
    {
        $sqrt = sqrt($number);
        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i == 0) {
                return array_merge(array($i), $this->getPrimeFactor($number/$i));
            }
        }
        return array($number);
    }

} 