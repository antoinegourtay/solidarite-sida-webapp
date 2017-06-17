<?php

namespace PeopleBundle\Tests\Importer;

use PeopleBundle\Importer\CSVImporter;

class CsvImporterTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_transform_csv_to_array()
    {
        $csv = __DIR__ . "/../Fixtures/users.csv";

        $users = CSVImporter::import($csv);
        $userNicolas = $users[0];

        $this->assertEquals('Nicolas', $userNicolas['firstName']);
        $this->assertEquals('Castells', $userNicolas['lastName']);
        $this->assertEquals('castellsnicolas1303@gmail.com', $userNicolas['email']);
        $this->assertEquals('13031995', $userNicolas['birthdate']);
        $this->assertEquals('0', $userNicolas['role']);

    }
}
