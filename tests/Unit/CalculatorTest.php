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


    public function test_one_plus_one()
    {
        $result = $this->calculator->calculate('1+1');
        $this->assertEquals(2, $result);
    }

    public function test_multiply_plus()
    {
        $result = $this->calculator->calculate('2+2+1');
        $this->assertEquals(5, $result);
    }
}
