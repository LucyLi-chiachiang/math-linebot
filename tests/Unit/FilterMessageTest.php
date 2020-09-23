<?php

namespace Tests\Unit;

use App\Services\FilterMessage;
use PHPUnit\Framework\TestCase;

class FilterMessageTest extends TestCase
{
    private FilterMessage $service;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->service = app()->make(FilterMessage::class);
    }

    public function testMessageIsFiltered()
    {
        $originMessage = 'abc123eee';
        $result = $this->service->filter($originMessage);
        $this->assertEquals('123', $result);
    }

    public function testNumbersAndSymbolsAreKept()
    {
        $originMessage = '123+321';
        $result = $this->service->filter($originMessage);
        $this->assertEquals('123+321', $result);
    }
}
