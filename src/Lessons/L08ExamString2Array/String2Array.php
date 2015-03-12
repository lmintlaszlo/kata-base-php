<?php

namespace Kata\Lessons\L08ExamString2Array;

use Kata\Lessons\L08ExamString2Array\Exceptions\InvalidStringException;

class String2Array
{
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
        
        return explode(',', $string);
    }
}
