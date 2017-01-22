<?php

namespace src\service;

use Src\Model\Transaction;

class Payments
{
    /**
     * Returns a list of total payments by currency
     *
     * @param Transaction[] $transactions
     * @return array
     */
    public function getPayments(array $transactions)
    {
        $totals = [];

        foreach ($transactions as $transaction) {
            if (!$transaction->isPayment()) {
                continue;
            }

            $amount = $transaction->getAmount();
            $currency = $amount->getCurrency();

            if (isset($totals[$currency])) {
                $totals[$currency] += $amount->getValue();
            } else {
                $totals[$currency]  = $amount->getValue();
            }
        }

        return $totals;
    }
}