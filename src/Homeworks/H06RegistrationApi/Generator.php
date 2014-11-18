<?php

namespace Kata\Homeworks\H06RegistrationApi;

class Generator
{
    public function generate()
    {
        return md5(mt_rand());
    }
}
