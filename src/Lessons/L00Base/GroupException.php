<?php

namespace Kata\Lessons\L00Base;

class GroupException extends \Exception
{
	const THE_PERSON_IS_ALREADY_A_MEMBER_OF_THE_GROUP = 208;

	private static $errorMessages = [
		self::THE_PERSON_IS_ALREADY_A_MEMBER_OF_THE_GROUP => 'The person is already a member of the group!',
	];

	public function __construct($code)
	{
		parent::__construct(self::$errorMessages[$code], $code);
	}
}
