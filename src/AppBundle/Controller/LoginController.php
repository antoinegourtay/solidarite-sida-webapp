<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Login;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/", name="home_login")
     */

    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $login = new Login();
        $login->setEmail('E-mail');
        $login->setPassword('Password');

        $form = $this->createFormBuilder($login)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $login = $form->getData();
            $email = $login->getEmail();
            $password = $login->getPassword();
            $client = new Client();
            $response = $client->request('GET', "http://www.benebox.org/offres/gestion/login/controle_login.php?login=$email&mot_de_passe=$password");
            $xmlResponse = (string) $response->getBody();

            if ($this->hasLoginSucceeded($xmlResponse)) {
                return $this->redirectToRoute('csv_controller');
            }

            return $this->redirectToRoute('login');
        }

        return $this->render('login.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function hasLoginSucceeded($xml)
    {
        $decodedXml = new \SimpleXMLElement($xml);
        return (string) $decodedXml->result['val'] === 'OK';
    }
}