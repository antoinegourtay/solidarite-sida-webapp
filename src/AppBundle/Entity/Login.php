<?php

namespace AppBundle\Entity;

class Login
{
    protected $email;
    protected $password;

    public function getEmail()
    {
    return $this->email;
    }

    public function setEmail($email)
    {
    $this->email = $email;
    }

    public function getPassword()
    {
    return $this->password;
    }

    public function setPassword($password)
    {
    $this->password = $password;
    }
}