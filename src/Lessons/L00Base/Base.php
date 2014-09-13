<?php

namespace Kata\Lessons\L00Base;

class Base
{
	const VERSION = 0.1;

	public function getVersion($condition = false)
	{
        if ($condition)
        {
            return self::VERSION;
        }
		return self::VERSION;
	}
}
