<?php
namespace PeopleBundle\Client;

use GuzzleHttp\Client;
use Symfony\Component\Routing\Annotation\Route;

class BeneboxClient
{
    const URL = 'http://www.benebox.org/offres/gestion/login/controle_login.php?login={EMAIL}&mot_de_passe={PASSWORD}';

    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function login($email, $password)
    {
        $response = $this->client->request('GET', $this->buildUrl($email, $password));
        $xmlResponse = (string) $response->getBody();
        $decodedXml = new \SimpleXMLElement($xmlResponse);

        return (string) $decodedXml->result['val'] === 'OK';
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    private function buildUrl($email, $password)
    {
        return str_replace('{PASSWORD}', $password, str_replace('{EMAIL}', $email, self::URL));
    }

}
