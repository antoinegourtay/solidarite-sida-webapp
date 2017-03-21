<?php
/**
 * Created by PhpStorm.
 * User: antoinegourtay
 * Date: 21/03/2017
 * Time: 17:16
 */

namespace AppBundle\Services;


class DataInterpretations
{
    public function getAge(\DateTime $datetime)
    {
        $interval = $datetime->diff(new \DateTime('now'));
        return $interval->y;
    }

}