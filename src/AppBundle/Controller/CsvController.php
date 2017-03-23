<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use CsvBundle\CsvImporter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CsvController extends Controller
{
    /**
     * @Route("/csv", name="csv_controller")
     */
    public function indexAction(Request $request)
    {

        $csvImporter = $this->get('csvImporter');

        $users = $csvImporter->import(__DIR__ . "/../../../tests/CsvBundle/Fixtures/users.csv");

        foreach ($users as $current){
            $user = new User();
            $user->setUsername($current['firstName']);
            $user->setEmail($current['email']);
            $user->setPassword('test');
            $user->setDriverLicence(false);

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render("csv.html.twig", array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
