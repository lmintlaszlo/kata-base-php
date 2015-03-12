<?php

namespace Kata\Lessons\L08ExamString2Array;

/**
 * Description of LabelledData
 *
 * @author schumann
 * 
 * @codeCoverageIgnore
 */
class LabelledData 
{
    private $labels;
    private $data;
    
    function __construct($labels, $data)
    {
        $this->labels = $labels;
        $this->data   = $data;
    }

    function getLabels()
    {
        return $this->labels;
    }

    function getData()
    {
        return $this->data;
    }


}
