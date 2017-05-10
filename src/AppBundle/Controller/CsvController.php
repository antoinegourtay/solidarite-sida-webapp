<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use CsvBundle\CsvImporter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Middleware\AuthenticationMiddleware;

class CsvController extends Controller
{
    /**
     * @Route("/csv", name="csv_controller")
     */
    public function indexAction(Request $request)
    {
        // Redirect if not logged in
        if(!AuthenticationMiddleware::isAuthenticated()) {
            return $this->redirectToRoute('login');
        }

        $csvImporter = $this->get('csvImporter');

        $users = $csvImporter->import(__DIR__ . "/../../../tests/CsvBundle/Fixtures/users.csv");

        foreach ($users as $current){
            $user = new User();
            $user->setFirstname($current['firstName']);
            $user->setName($current['lastName']);
            $user->setEmail($current['email']);
            $birthdate = \DateTime::createFromFormat('dmY', $current['birthdate']);
            $user->setBirthdate($birthdate);
            $user->setPassword('test');
            $user->setDriverLicence(false);
            $user->setPhoneNumber($current['phoneNumber']);
            $user->setAdress($current['adress']);
            $user->setZipcode($current['zipcode']);
            $user->setCity($current['city']);

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render("csv.html.twig", array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}