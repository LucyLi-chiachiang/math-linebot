<?php


namespace App\Services;


class FilterMessage
{
    public function filter($string)
    {
        $string = preg_replace("/[^0-9+]/",'', $string);

        return $string;
    }
}
