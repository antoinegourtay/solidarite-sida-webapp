<?php

namespace AppBundle\Middleware;

class AuthenticationMiddleware
{
    public static function isAuthenticated()
    {
        return isset($_SESSION['user.email']);
    }

    public static function authenticate($email)
    {
        $_SESSION['user.email'] = $email;
    }
}