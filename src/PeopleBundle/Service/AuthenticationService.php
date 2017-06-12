<?php
namespace PeopleBundle\Service;

use PeopleBundle\Client\BeneboxClient;
use \InvalidArgumentException;
use PeopleBundle\Entity\People;
use PeopleBundle\Repository\PeopleRepository;

class AuthenticationService
{
    /** @var BeneboxClient */
    private $beneboxClient;

    /** @var PeopleRepository */
    private $peopleRepository;

    /**
     * @param BeneboxClient    $beneboxClient
     * @param PeopleRepository $peopleRepository
     */
    public function __construct(
        BeneboxClient $beneboxClient,
        PeopleRepository $peopleRepository
    ) {
        $this->beneboxClient = $beneboxClient;
        $this->peopleRepository = $peopleRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return People
     */
    public function login($email, $password)
    {
        $successBeneboxAuthentication = $this->beneboxClient->login($email, $password);
        if (!$successBeneboxAuthentication) {
            throw new InvalidArgumentException('Password/Email invalid');
        }

        $user = $this->peopleRepository->getFromEmail($email);
        if (!$user) {
            throw new InvalidArgumentException('User does not exist');
        }

        return $user;
    }
}
