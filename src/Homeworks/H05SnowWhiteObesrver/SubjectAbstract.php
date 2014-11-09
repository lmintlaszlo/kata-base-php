<?php

abstract class SubjectAbstract
{
    abstract public function attach(ObserverAbstract $newObserver);
    abstract public function detach(ObserverAbstract $oldObserver);
    abstract public function notify();
}
