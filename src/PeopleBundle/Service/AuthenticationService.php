<?php
namespace PeopleBundle\Service;

use PeopleBundle\Client\BeneboxClient;
use \InvalidArgumentException;
use PeopleBundle\Entity\People;
use PeopleBundle\Repository\PeopleRepository;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @param Request $request
     * @return bool
     */
    public function isAuthenticated(Request $request)
    {
        $email = $request->getSession()->get('user.email');
        if (!$email) {
            return false;
        }

        $user = $this->peopleRepository->getFromEmail($email);
        if (!$user) {
            return false;
        }

        return true;
    }
}
