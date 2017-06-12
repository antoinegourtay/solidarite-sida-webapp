<?php

namespace CsvBundle\Tests;

use CsvBundle\CsvImporter;

class CsvImporterTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_transform_csv_to_array()
    {
        $csv = __DIR__ . "/Fixtures/users.csv";

        $CsvImporter = new CsvImporter();
        $users = $CsvImporter->import($csv);
        $userNicolas = $users[0];

        $this->assertEquals('Nicolas', $userNicolas['firstName']);
        $this->assertEquals('Castells', $userNicolas['lastName']);
        $this->assertEquals('castellsnicolas1303@gmail.com', $userNicolas['email']);
        $this->assertEquals('22', $userNicolas['age']);
        $this->assertEquals('god', $userNicolas['role']);

    }
}