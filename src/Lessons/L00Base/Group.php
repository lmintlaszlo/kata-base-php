<?php

namespace Kata\Lessons\L00Base;

class Group implements \Countable
{
	private $name;
	/** @var Person[] */
	private $people = [];

	public function __construct($name = '')
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function add(Person $person)
	{
		foreach ($this->people as $groupMember)
		{
			if ($person === $groupMember)
			{
				throw new GroupException(GroupException::THE_PERSON_IS_ALREADY_A_MEMBER_OF_THE_GROUP);
			}
		}
		$this->people[] = $person;
	}

	public function count()
	{
		return count($this->people);
	}

	public function listNamesByAge()
	{
		$listByAge = [];
		foreach ($this->people as $person)
		{
			$listByAge[$person->getAge()] = $person->getFullName();
		}

		ksort($listByAge);

		return array_values($listByAge);
	}

	public function getSize()
	{
		$count = count($this->people);
		if ($count === 0)
		{
			return null;
		}
		elseif ($count <= 5)
		{
			return 'small';
		}
		elseif ($count <= 20)
		{
			return 'medium';
		}

		return 'large';
	}
}
