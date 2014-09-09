<?php

namespace Kata;

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
