<?php
namespace EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @Method({ "GET" })
     */
    public function dashboardAction(Request $request)
    {
        if (!$this->container->get('AuthenticationService')->isAuthenticated($request)) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/dashboard.html.twig');
    }
}
