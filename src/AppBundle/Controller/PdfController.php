<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends Controller
{
    /**
     * @return Response
     *
     * @Route("/pdf")
     */
    public function indexAction()
    {
        //TODO: Get informations from the volunteers table with Doctrine

        $snappy = $this->get('knp_snappy.pdf');

        /**
         * In the array, we put the data we want to pass to the twig template
         */
        $html = $this->renderView('pdf/index.html.twig', array(
            'title' => 'bonjour'
        ));

        $filename = 'Trombinoscope';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }
}
