<?php
namespace PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PeopleController extends Controller
{
    /**
     * @Route("/login", name="account_login")
     * @Method({ "POST" })
     */
    public function loginAction(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        try {
            $user = $this->container->get('AuthenticationService')->login($email, $password);
            return JsonResponse::create([
                'error' => false,
                'user'  => [
                    'id'    => $user->getId(),
                    'email' => $user->getEmail(),
                ],
            ]);
        } catch (\InvalidArgumentException $exception) {
            return JsonResponse::create([
                "error"   => true,
                "message" => $exception->getMessage(),
            ], 401);
        }
    }
}