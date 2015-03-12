<?php

namespace Kata\Lessons\L08ExamString2Array;

use Kata\Lessons\L08ExamString2Array\Exceptions\InvalidStringException;
use Kata\Lessons\L08ExamString2Array\Exceptions\InvalidLabelledStringException;

class String2Array
{
    const SEPARATOR_COMMA = ",";
    const SEPARATOR_NL    = "\n";
    
    const LABELLED_STRING_BEGIN = "#useFirstLineAsLabels";
    
    /**
     * Handles one line strings.
     * 
     * @param type $string  The string to be parsed
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
    
    /**
     * Parses a string by labels.
     * 
     * @param string $string  The string to be parsed
     * 
     * @throws InvalidStringException
     */
    public function useLabels($string)
    {
        if (!is_string($string) || !$this->isLabelled($string))
        {
            throw new InvalidLabelledStringException('Invalid string');
        }
        
        $lines  = explode(self::SEPARATOR_NL, $string);        
        $labels = explode(self::SEPARATOR_COMMA, $lines[1]);
        $data   = array();
        
        unset($lines[0], $lines[1]);
        
        foreach ($lines as $line)
        {
            $data[] = explode(self::SEPARATOR_COMMA, $line);
        }
        
        return new LabelledData($labels, $data);
    }
    
    /**
     * Checks if a string is labelled.
     * 
     * @param string $string  The string
     * 
     * @return boolean
     */
    private function isLabelled($string)
    {        
        return (bool)preg_match("/^".self::LABELLED_STRING_BEGIN."\n/", $string);
    }
}
