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
        $pdf = $this->get('knp_snappy.pdf');
        $pdf->setOption('page-size', 'A3');

        $html = $this->renderView('pdf/index.html.twig', array(
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
}
