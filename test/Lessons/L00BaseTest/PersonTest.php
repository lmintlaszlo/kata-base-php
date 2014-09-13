<?php

use Kata\Lessons\L00Base\Person;

class PersonTest extends \PHPUnit_Framework_TestCase
{
	public function personDataProvider()
	{
		return [
			['John', 'Doe', 32],
			['Jane', 'Deo', 23],
			['Jany', 'Edo', 45],
			['Jay', 'Ode', 54]
		];
	}

	/**
	 * @dataProvider personDataProvider
	 *
	 * @param $firstName
	 * @param $lastName
	 * @param $age
	 */
	public function testPersonStoresAndReturnsTheSameData($firstName, $lastName, $age)
	{
		$person = new Person($firstName, $lastName, $age);

		$this->assertEquals($firstName, $person->getFirstName());
		$this->assertEquals($lastName, $person->getLastName());
		$this->assertEquals($age, $person->getAge());
	}

	/**
	 * @dataProvider personDataProvider
	 *
	 * @param $firstName
	 * @param $lastName
	 * @param $age
	 */
	public function testFullName($firstName, $lastName, $age)
	{
		$person = new Person($firstName, $lastName, $age);

		$this->assertEquals("$firstName $lastName", $person->getFullName());
	}
}
