<?php

namespace Kata\Lessons\L06Exam;

class StringCalculator
{
    public function add($numberString)
    {
        $sum = 0;
        
        $numbers = explode(',', $numberString);
        
        foreach ($numbers as $number)
        {
            $realInteger = (int)$number;
            $sum += $realInteger;
        }
        
        return $sum;
    }
}
