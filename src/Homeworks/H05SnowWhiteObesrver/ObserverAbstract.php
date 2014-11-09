<?php

abstract class ObserverAbstract
{
    public function update(SubjectAbstract $subject)
    {
        $message = $subject->getMessage();
        if ($message == SnowWhite::MESSAGE_STAND_UP)
        {
            $message = SnowWhite::MESSAGE_STAND_UP_2;
        }
        
        echo str_pad(get_class($this), 7, ' ') . ': ' . $message . PHP_EOL;
        
        sleep(1);
    }
}
