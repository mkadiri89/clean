<?php

require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);

use src\service\Payments;
use src\service\StatementParser;

/**
 * @author Mohammed Kadiri
 *
 * To run the file type in the command below in git bash
 * php Bootstrap.php
 */
class Bootstrap
{
    public static function main()
    {
        $transactions = (new StatementParser('statement.csv'))->parse();
        $totals = (new Payments())->getPayments($transactions);

        foreach ($totals as $currency => $total) {
            echo $currency . ' ' . number_format($total, 2) . "\n";
        }
    }
}

Bootstrap::main();
