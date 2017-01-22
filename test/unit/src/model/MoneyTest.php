<?php

namespace test\unit\src\model;

use PHPUnit_Framework_TestCase;
use src\model\Money;

class MoneyTest extends PHPUnit_Framework_TestCase
{
    public function testGetValueValid()
    {
        $this->assertEquals(1000, (new Money(1000, 'GBP'))->getValue());
    }

    public function testGetCurrencyValid()
    {
        $this->assertEquals('GBP', (new Money(1000, 'GBP'))->getCurrency());
    }
}
