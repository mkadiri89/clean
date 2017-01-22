<?php

namespace src\model;

use Exception;

class Money
{
    private $value;
    private $currency;

    public function __construct($value, $currency)
    {
        if (!$value) {
            throw new Exception ('Money value has not been set');
        }

        if (!is_numeric($value)) {
            throw new Exception ('Money value is a not a valid number');
        }

        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}