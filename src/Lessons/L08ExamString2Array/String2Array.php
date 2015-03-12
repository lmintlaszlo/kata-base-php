<?php

namespace Kata\Lessons\L08ExamString2Array;

use Kata\Lessons\L08ExamString2Array\Exceptions\InvalidStringException;

class String2Array
{
    const SEPARATOR_COMMA = ",";
    const SEPARATOR_NL    = "\n";
    
    /**
     * Handles one line strings.
     * 
     * @param type $string
     * 
     * @throws InvalidStringException
     */
    public function oneLine($string)
    {        
        if (!is_string($string))
        {
            throw new InvalidStringException('Invalid string');
        }
        
        $values = array();        
        $lines  = explode(self::SEPARATOR_NL, $string);
        
        foreach ($lines as $line)
        {
            $newValues = explode(self::SEPARATOR_COMMA, $line);
            $values    = array_merge($values, $newValues);
        }
        
        
        return array(
            'lines'  => $lines,
            'values' => $values,
        );
    }
}
