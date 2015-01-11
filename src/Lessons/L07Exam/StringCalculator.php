<?php

namespace Kata\Lessons\L07Exam;

class StringCalculator
{    
    
    const DELIMITER_SEPARATOR = "\n";
    
    const NEGATIVE_EXCEPTION_STRING = "Negatives not allowed! Received:";
    
    // Indicates the numberstring
    private $numberString;
    
    // Indicates the given delimiter
    private $delimiter = '(\n|,)';
    
    // Array to store the receives negative numbers
    private $negatives = array();
    
    // Indicates if a custom delimiter is given
    private $customDelimiterGiven = false;
    
    public function add($numberString)
    {
        $sum = 0;
        
        $this->initDelimiter($numberString);
        $this->initNumberString($numberString);
        
        $numbers = preg_split("/".urldecode($this->delimiter)."/", $this->numberString);

        foreach($numbers as $number)
        {
            $realInteger = (int)trim($number);
            
            if ($this->isNegative($realInteger))
            {
                $this->collectNegatives($realInteger);                
            }
            else
            {
                $sum += $realInteger;
            }
        }
        
        $this->checkNegatives();
        
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
    
    /**
     * Checks if a number is negative.
     * 
     * @param int $number  The number to be checked
     * 
     * @return boolean  True if negative, false otherwise
     */
    private function isNegative($number)
    {
        return ($number < 0);
    }
    
    /**
     * Collects the received negative numbers.
     * 
     * @param int $number  The number to check for negativity
     * 
     * @return void
     */
    private function collectNegatives($number)
    {
        if ($number < 0)
        {
            $this->negatives[] = $number;
        }
    }
    
    /**
     * Checks if a negative number was received and throws exception if was.
     * 
     * @throws NegativeFoundException
     */
    private function checkNegatives()
    {
        if(!empty($this->negatives))
        {
            throw new NegativeFoundException('Negatives not allowed! Received:' . implode(', ', $this->negatives));
        }
    }
}
