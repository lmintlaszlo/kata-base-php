<?php

namespace Kata\Test;

use Kata\Base;

class BaseTest extends \PHPUnit_Framework_TestCase
{
	public function testBase()0
	{
		$base = new Base();

		$this->assertEquals(0.1, $base->getVersion(true));
$this->assertEquals(0.1, $base->getVersion());
	}
}
