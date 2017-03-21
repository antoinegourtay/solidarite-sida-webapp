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
     * @Route("/pdftrombi")
     */
    public function trombiAction()
    {

        //TODO: Get informations from the volunteers table with Doctrine

        $pdf = $this->get('knp_snappy.pdf');

        /* Here we will put the options we want */
        $pdf->setOption('page-size', 'A3');

        /**
         * In the array, we put the data we want to pass to the twig template
         */
        $html = $this->renderView('pdf/trombi.html.twig', array(
            'title' => 'bonjour'
        ));

        $filename = 'Trombinoscope';

        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

    /**
     * @return Response
     *
     * @Route("/pdfcallsheet")
     */
    public function callsheetAction(){

        $pdf = $this->get('knp_snappy.pdf');

        /* Here we will put the options we want */
        $pdf->setOption('page-size', 'A3');

        /**
         * In the array, we put the data we want to pass to the twig template
         */
        $html = $this->renderView('pdf/callsheet.html.twig', array(
            'title' => 'Feuille d\'appel'
        ));

        $filename = 'Trombinoscope';

        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

}
