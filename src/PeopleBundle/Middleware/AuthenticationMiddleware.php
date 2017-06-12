<?php

namespace PeopleBundle\Middleware;

class AuthenticationMiddleware
{
    /**
     * The function checks if the SESSION token is set
     * @return bool
     */
    public static function isAuthenticated()
    {
        return isset($_SESSION['user.email']);
    }

    /**
     * This function instaciate the SESSION token on connection
     * @param $email
     */
    public static function authenticate($email)
    {
        $_SESSION['user.email'] = $email;
    }

}
