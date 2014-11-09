<?php


class Doc extends ObserverAbstract
{
    public function update(SubjectAbstract $subject)
    {
        echo str_pad(get_class(), 7, ' ') . ': ' . $subject->getMessage() . PHP_EOL;
    }

}
