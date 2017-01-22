<?php

namespace test\unit\src\model;

use PHPUnit_Framework_TestCase;
use src\model\Money;
use src\model\Transaction;

class TransactionTest extends PHPUnit_Framework_TestCase
{
    protected $money;

    public function setUp()
    {
        $this->money = $this->getMockBuilder(Money::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetIsPaymentValid()
    {
        $transaction = new Transaction(
            'PAY000000AB', '06/03/2011', $this->money, 'Debit'
        );

        $this->assertTrue($transaction->isPayment());
    }

    public function testGetIsPaymentInvalid()
    {
        $transaction = new Transaction(
            '67GYGT7CJB76760', '06/03/2011', $this->money, 'Debit'
        );

        $this->assertFalse($transaction->isPayment());
    }
}
