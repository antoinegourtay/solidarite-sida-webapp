<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use CsvBundle\CsvImporter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $csvImporter = new CsvImporter();

        $users = $csvImporter->import(__DIR__ . "/../../../tests/CsvBundle/Fixtures/users.csv");

        foreach ($users as $current){
            $user = new User();
            $user -> setUsername($current['firstName']);
            $user -> setEmail($current['email']);
            $user -> setPassword('test');
            $user -> setDriverLicence(false);

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
