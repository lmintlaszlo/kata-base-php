<?php

namespace Kata\Lessons\L06Exam;

class StringCalculator
{
    public function add($numberString)
    {
        $sum = 0;
        
        //$numbers = explode(',', $numberString);
        $numbers = preg_split("/(\n|,)/", $numberString);
        
        foreach ($numbers as $number)
        {
            $realInteger = (int)trim($number);
            $sum += $realInteger;
        }
        
        return $sum;
    }
}
