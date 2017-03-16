<?php

namespace CsvBundle;

class CsvImporter
{
    /**
     * @param string $csvFile
     * @return array
     */
    public function import($csvFile)
    {
        $csv = array_map('str_getcsv', file($csvFile));

        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });

        array_shift($csv);

        return $csv;
    }
}