<?php

namespace src\model;

class Transaction
{
    private $reference;
    private $date;
    private $type;
    private $amount;

    public function __construct($reference, $date, Money $amount, $type)
    {
        $this->reference = $reference;
        $this->date = $date;
        $this->type = $type;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return boolean
     */
    public function isPayment()
    {
        return preg_match("/PAY([0-9]{6})([A-Z]{2})/", $this->reference) ? true : false;
    }
}