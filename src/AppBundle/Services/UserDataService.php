<?php
/**
 * Created by PhpStorm.
 * User: antoinegourtay
 * Date: 25/04/2017
 * Time: 15:07
 */

namespace AppBundle\Services;


class UserDataService
{

    /**
     * We want to get the current user connected
     * @return mixed
     */
    public function getCurrentUserConnectedId()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();
        $currentUserId = $currentUser->getId();
        return $currentUserId;
    }

    public function getCurrentUserConnectedUsername()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();
        $currentUserUsername = $currentUser->getUsername();
        return $currentUserId;
    }

}