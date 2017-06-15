<?php
namespace PeopleBundle\Controller;

use PeopleBundle\Entity\People;
use PeopleBundle\Importer\CSVImporter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
            $request->getSession()->set('user.email', $user->getEmail());
            return $this->redirectToRoute('dashboard');
        } catch (\InvalidArgumentException $exception) {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/", name="homepage")
     * @Method({ "GET" })
     */
    public function homepageAction(Request $request)
    {
        if ($this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('@PeopleBundle/homepage.html.twig');
    }

    /**
     * @Route("/import", name="import")
     * @Method({ "POST" })
     */
    public function importAction(Request $request)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (!$this->get('CurrentUser')->get()->isAdmin()) {
            return $this->redirectToRoute('dashboard');
        }

        $csvFile = $request->files->get('csvFile');
        $people = CSVImporter::import($csvFile->getRealPath());

        foreach($people as $person) {
            /** @var People $databaseEntry */
            $databaseEntry = $this->get('PeopleRepository')->getFromEmail($person['email']);

            if (!$databaseEntry) {
                // CREATE NEW USER TO DATABASE
                $newPerson = new People();
                $newPerson->setEmail($person['email']);
                $newPerson->setFirstName($person['firstName']);
                $newPerson->setLastName($person['lastName']);
                $newPerson->setAddress($person['address']);
                $newPerson->setZipcode($person['zipcode']);
                $newPerson->setCity($person['city']);
                $newPerson->setPhone($person['phone']);
                $newPerson->setDriverLicense($person['driverLicense']);
            } else {
                // UPDATE ALREADY EXISTING INFOS
                $newPerson = $databaseEntry;
                $newPerson->setFirstName($person['firstName']);
                $newPerson->setLastName($person['lastName']);
                $newPerson->setAddress($person['address']);
                $newPerson->setZipcode($person['zipcode']);
                $newPerson->setCity($person['city']);
                $newPerson->setPhone($person['phone']);
                $newPerson->setDriverLicense($person['driverLicense']);
            }

            // UPDATE/ADD TEAM

            // SAVE CHANGES
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($newPerson);
            $em->flush();
        }

        return $this->redirectToRoute('dashboard');
    }
}
