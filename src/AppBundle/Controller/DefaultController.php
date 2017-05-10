<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Middleware\AuthenticationMiddleware;

class DefaultController extends Controller
{
    /**
     * @Route("/cs", name="csv_importer")
     */
    public function newAction(Request $request)
    {
        // Redirect if not logged in
        if(!AuthenticationMiddleware::isAuthenticated()) {
            return $this->redirectToRoute('login');
        }
        
        $task = new Task();

        $form = $this->createFormBuilder($task)
            ->add('importer', FileType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $file = $task->getImporter();

            $fileName = 'users'.'.'.'csv';

            $file->move(
                __DIR__  . "/../../../tests/CsvBundle/Fixtures/",
                $fileName
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('csv_controller');
        }

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}