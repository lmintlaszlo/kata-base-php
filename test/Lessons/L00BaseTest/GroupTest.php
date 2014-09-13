<?php

use Kata\Lessons\L00Base\Group;

class GroupTest extends \PHPUnit_Framework_TestCase
{
	public function testGroupCanHaveAName()
	{
		$groupName = 'A team';

		$group = new Group($groupName);

		$this->assertEquals($groupName, $group->getName());
	}

	public function testAddPersonToGroupAndCheckCountIsOne()
	{
		$person = $this->getMockBuilder('Kata\\Lessons\\L00Base\\Person')->disableOriginalConstructor()->getMock();

		$group = new Group();
		$group->add($person);

		$this->assertEquals(1, count($group));
	}

	/**
	 * @expectedException       \Kata\Lessons\L00Base\GroupException
	 * @expectedExceptionCode   208
	 */
	public function testSamePersonCanNotBeAddedTwice()
	{
		$person = $this->getMockBuilder('Kata\\Lessons\\L00Base\\Person')->disableOriginalConstructor()->getMock();

		$group = new Group();
		$group->add($person);
		$group->add($person);
	}

	public function testAddTwoPeopleToGroupAndCheckCountIsTwo()
	{
		$person1 = $this->getMockBuilder('Kata\\Lessons\\L00Base\\Person')->disableOriginalConstructor()->getMock();
		$person2 = clone $person1;

		$group = new Group();
		$group->add($person1);
		$group->add($person2);

		$this->assertEquals(2, count($group));
	}

	public function testListingOfThreePerson()
	{
		$person1 = $this->getMockBuilder('Kata\\Lessons\\L00Base\\Person')->disableOriginalConstructor()->getMock();
		$person2 = clone $person1;
		$person3 = clone $person1;
		$person1->expects($this->once())->method('getFullName')->willReturn('John Doe');
		$person1->expects($this->once())->method('getAge')->willReturn(32);
		$person2->expects($this->once())->method('getFullName')->willReturn('Jane Deo');
		$person2->expects($this->once())->method('getAge')->willReturn(23);
		$person3->expects($this->once())->method('getFullName')->willReturn('Jany Edo');
		$person3->expects($this->once())->method('getAge')->willReturn(45);

		$group = new Group();
		$group->add($person1);
		$group->add($person2);
		$group->add($person3);

		$this->assertEquals(
			[
				'Jane Deo',
				'John Doe',
				'Jany Edo'
			],
			$group->listNamesByAge()
		);
	}

	public function groupSizeCalculationDataProvider()
	{
		$group = [
			'small'  => [],
			'medium' => [],
			'large'  => []
		];

		$person = $this->getMockBuilder('Kata\\Lessons\L00Base\\Person')->disableOriginalConstructor()->getMock();

		for ($i = 0; $i < 25; $i++)
		{
			$clonedPerson = clone $person;
			if ($i < 3)
			{
				$group['small'][] = $clonedPerson;
			}
			if ($i < 12) {
				$group['medium'][] = $clonedPerson;
			}
			$group['large'][] = $clonedPerson;
		}

		return [
			[[], null],
			[[$person], 'small'],
			[$group['small'], 'small'],
			[$group['medium'], 'medium'],
			[$group['large'], 'large'],
		];
	}

	/**
	 * @dataProvider groupSizeCalculationDataProvider
	 *
	 * @param array $people
	 * @param int   $expectedSize
	 */
	public function testGroupSizeIsCalculatedCorrectly(array $people, $expectedSize)
	{
		$group = new Group();

		foreach ($people as $person)
		{
			$group->add($person);
		}

		$this->assertEquals($expectedSize, $group->getSize());
	}
}
