<?php

namespace Kata\Lessons\L06Exam;

class StringCalculator
{    
    
    CONST DELIMITER_SEPARATOR = "\n";
    
    // Indicates the numberstring
    private $numberString;
    
    // Indicates the given delimiter
    private $delimiter = '(\n|,)';
    
    // Indicates if a custom delimiter is given
    private $customDelimiterGiven = false;
    
    public function add($numberString)
    {
        $sum = 0;
        $negatives = array();
        
        $this->initDelimiter($numberString);
        $this->initNumberString($numberString);
        
        $numbers = preg_split("/".urldecode($this->delimiter)."/", $this->numberString);

        foreach($numbers as $number)
        {
            $realInteger = (int)trim($number);
            
            if ($realInteger < 0)
            {
                $negatives[] = $number;
            }
            
            $sum += $realInteger;
        }
        
        if(!empty($negatives))
        {
            throw new NegativeFoundException('Negatives not allowed! Received:' . implode(', ', $negatives));
        }
        
        return $sum;
    }
    
    /**
     * Initializes the delimiter to be used for separating the numbers.
     * 
     * @param string $numberString  The string containing the delimiter and the numbers
     */
    private function initDelimiter($numberString)
    {        
        if(preg_match("#//(.*)".self::DELIMITER_SEPARATOR."[0-9]#", $numberString, $matches))
        {
            $this->customDelimiterGiven = true;
            $this->delimiter = urlencode($matches[1]);
        }
    }
    
    /**
     * Returns the array of the numbers to be summed.
     * 
     * @param string $numberString
     * 
     * return array
     */
    private function initNumberString($numberString)
    {
        $this->numberString = $numberString;
        
        if(true === $this->customDelimiterGiven)
        {
            $array = explode(self::DELIMITER_SEPARATOR, $numberString);
            $this->numberString = $array[1];
        }        
    }
}
