<?php


class SnowWhite extends SubjectAbstract
{
    const NARATOR_SIT_DOWN   = 'Hofeherke leult a tukor ele a szerkre.';
    const NARATOR_COMB_HAIR  = 'Hofeherke a hajat fesuli.';
    const NARATOR_STRIP_DOWN = 'Hofeherke levette a ruhait.';
    const NARATOR_STAND_UP   = 'Hofeherke felallt a szekrol.';
    
    const MESSAGE_SIT_DOWN    = 'Leult.';
    const MESSAGE_COMB_HAIR   = 'Fesuli.';
    const MESSAGE_STRIP_DOWN  = 'Levette.';
    const MESSAGE_STAND_UP    = 'Felalt.';
    const MESSAGE_STAND_UP_2  = 'Nekem is...';
    
    private $observers = array();
    private $message   = '';

    public function attach(ObserverAbstract $newObserver)
    {
        $this->observers[] = $newObserver;
    }
    
    public function detach(ObserverAbstract $oldObserver)
    {
        $key = array_search($oldObserver, $this->observers);
        
        if ($key)
        {
            unset($this->observers[$key]);            
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->update($this);
        }
    }
    
    public function sitDown()
    {
        echo PHP_EOL . self::NARATOR_SIT_DOWN . PHP_EOL . PHP_EOL;
        $this->message = self::MESSAGE_SIT_DOWN;
        $this->notify();
    }
    
    public function combHair()
    {
        echo PHP_EOL . self::NARATOR_COMB_HAIR . PHP_EOL . PHP_EOL;
        $this->message = self::MESSAGE_COMB_HAIR;
        $this->notify();
    }
    
    public function stripDown()
    {
        echo PHP_EOL . self::NARATOR_STRIP_DOWN . PHP_EOL . PHP_EOL;
        $this->message = self::MESSAGE_STRIP_DOWN;
        $this->notify();
    }
    
    public function standUp()
    {
        echo PHP_EOL . self::NARATOR_STAND_UP . PHP_EOL . PHP_EOL;
        $this->message = self::MESSAGE_STAND_UP;
        $this->notify();
    }
    
    public function getMessage()
    {
        return $this->message;
    }

}
