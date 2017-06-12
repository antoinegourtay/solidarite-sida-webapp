<?php
namespace PeopleBundle\Service;

use PeopleBundle\Client\BeneboxClient;
use \InvalidArgumentException;

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
     * @return array
     */
    public function login($email, $password)
    {
        $successBeneboxAuthentication = $this->beneboxClient->login($email, $password);

        if (!$successBeneboxAuthentication) {
            throw new InvalidArgumentException('Password/Email invalid');
        }

        return [];
    }
}
