<?php

namespace App\Services;

class FilterMessage
{
    public function filter($string)
    {
        return preg_replace("/[^0-9+]/",'', $string);
    }
}
