<?php
/**
 * Created by PhpStorm.
 * User: antoinegourtay
 * Date: 10/05/2017
 * Time: 11:30
 */

namespace AppBundle\Middleware;


use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Class InformationsRetrieverMiddleware
 *
 * @package AppBundle\Middleware
 */
class InformationsRetrieverMiddleware
{

    /**
     * The function gets the current user connected
     *
     * @return mixed
     */
    public static function getCurrentUser()
    {
        $email = $_SESSION['user.email'];
        return $email;
    }

}