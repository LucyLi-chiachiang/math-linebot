<?php

namespace Tests\Unit;

use App\Services\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->calculator = app()->make(Calculator::class);
    }


    public function testOnePlusOne()
    {
        $result = $this->calculator->calculate('1+1');
        $this->assertEquals(2, $result);
    }

    public function testMultiPlus()
    {
        $result = $this->calculator->calculate('2+2+1');
        $this->assertEquals(5, $result);
    }
}
