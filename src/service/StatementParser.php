<?php

namespace src\service;

use Exception;
use src\model\Money;
use src\model\Transaction;

class StatementParser
{
    protected $filePath;
    protected $fileHandler;

    public function __construct($fileName)
    {
        $this->filePath = __DIR__ . '/../../input/' . $fileName;

        if (!file_exists($this->filePath)) {
            throw new Exception('File does not exist');
        }

        $this->fileHandler = fopen($this->filePath, 'r');
        $this->fileHandlerLength = 500;
    }

    /**
     * Extracts transactions from a CSV file and returns a formatted list
     *
     * @return Transaction[]
     */
    public function parse()
    {
        $header = $this->getHeader();
        $results = [];

        while ($line = fgetcsv($this->fileHandler, $this->fileHandlerLength, ',')) {
            $data = array_combine($header, $line);
            $value = $data['credit'] ? $data['credit'] : $data['debit'];
            $type = $data['credit'] ? 'Credit' : 'Debit';

            $results[] = new Transaction(
                $data['narrative_1'],
                $data['date'],
                new Money($value, $data['currency']),
                $type
            );
        }

        return $results;
    }

    /**
     * Returns formatted header names
     *
     * @return array
     */
    private function getHeader()
    {
        $header = fgetcsv($this->fileHandler, $this->fileHandlerLength, ',');

        foreach ($header as $key => $elem) {
            $elem = str_replace(' ', '_', $elem);
            $elem = strtolower($elem);
            $header[$key] = $elem;
        }

        return $header;
    }
}