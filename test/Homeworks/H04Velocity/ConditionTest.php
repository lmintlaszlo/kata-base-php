<?php

use Kata\Homeworks\H04Velocity\Condition;

class ConditionTest extends \PHPUnit_Framework_TestCase
{    
    protected $condition;
    
    protected function setUp()
    {
        $this->condition = new Condition();
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Condition::setCounter
     * 
     */
    public function testSetCounter()
    {
        $newCounter = 10;
        $this->condition->setCounter($newCounter);
        $this->assertEquals($newCounter, $this->condition->getCounter());
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Condition::setCounter
     * 
     */
    public function testGetCounter()
    {
        $newCounter = 10;
        $this->condition->setCounter($newCounter);
        $this->assertEquals($newCounter, $this->condition->getCounter());
    }
    
    /**
     * @covers \Kata\Homeworks\H04Velocity\Condition::isLimitReached
     * @uses \Kata\Homeworks\H04Velocity\Condition
     * @dataProvider isLimitReachedProvider
     */
    public function testIsLimitReached($expectedStatus, $counter)
    {
        $this->condition->setCounter($counter);
        $this->assertEquals($expectedStatus, $this->condition->isLimitReached());
    }
    
    
    /** Data Providers */
    
    public function isLimitReachedProvider()
    {
        return array(
            array(false, 0),
            array(false, 50),
            array(true, 100),
            array(true, 100000),
        );
    }
}
