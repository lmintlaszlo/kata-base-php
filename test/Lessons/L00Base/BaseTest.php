<?php

namespace Kata\Test;

use Kata\Lessons\L00Base\Base;

class BaseTest extends \PHPUnit_Framework_TestCase
{
	public function testBase()
	{
		$base = new Base();

		$this->assertEquals(0.1, $base->getVersion(true));
        $this->assertEquals(0.1, $base->getVersion());
	}
}
