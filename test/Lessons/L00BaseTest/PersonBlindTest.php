<?php

use Kata\Lessons\L00Base\Person;

/**
 * Test for the Person class, the blind way, this is what you will start with
 * and end up with the normal PersonTest class, which has been refactored to
 * leave out code duplication with the use of data providers.
 */
class PersonBlindTest extends \PHPUnit_Framework_TestCase
{
	public function testStoreMySelf()
	{
		$firstName = 'John';
		$lastName  = 'Doe';
		$age       = 32;

		$person = new Person($firstName, $lastName, $age);

		$this->assertEquals($firstName, $person->getFirstName());
		$this->assertEquals($lastName, $person->getLastName());
		$this->assertEquals($age, $person->getAge());
	}

	public function testStoreOther()
	{
		$firstName = 'Jane';
		$lastName  = 'Deo';
		$age       = 23;

		$person = new Person($firstName, $lastName, $age);

		$this->assertEquals($firstName, $person->getFirstName());
		$this->assertEquals($lastName, $person->getLastName());
		$this->assertEquals($age, $person->getAge());
	}

	public function testFullName()
	{
		$firstName = 'Jany';
		$lastName  = 'Edo';
		$age       = 45;

		$person = new Person($firstName, $lastName, $age);

		$this->assertEquals("$firstName $lastName", $person->getFullName());
	}
}
