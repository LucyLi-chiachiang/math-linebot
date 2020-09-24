<?php

namespace App\Services;

class Calculator
{
    private FilterMessage $filterService;
    public function __construct(FilterMessage $filterService)
    {
        $this->filterService = $filterService;
    }

    public function calculate($string)
    {
        $mathExpress = $this->filterService->filter($string);
        $numbers = preg_split("/[+]/", $mathExpress);
        $result = 0;
        foreach ($numbers as $num)
        {
            $result += $num;
        }
        return $result;
    }
}
