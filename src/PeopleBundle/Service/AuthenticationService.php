<?php
namespace PeopleBundle\Service;

use PeopleBundle\Client\BeneboxClient;

class AuthenticationService
{
    private $beneboxClient;

    /**
     * @param BeneboxClient $beneboxClient
     */
    public function __construct(BeneboxClient $beneboxClient)
    {
        $this->beneboxClient = $beneboxClient;
    }

    /**
     * @param string $email
     * @param string $password
     */
    public function login($email, $password)
    {
        $success = $this->beneboxClient->login($email, $password);
        dump($success);
        exit;
    }
}
