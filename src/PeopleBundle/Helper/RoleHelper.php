<?php
namespace PeopleBundle\Helper;

class RoleHelper
{
    const BENEVOLE = 1;
    const CHIEF_SUBTEAM = 2;
    const CHIEF_POLE = 3;
    const CHIEF_TEAM = 4;
    const COORDINATOR = 5;
    const VOLONTARIA = 6;

    const ROLES = [
        self::BENEVOLE      => 'Bénévole',
        self::CHIEF_SUBTEAM => 'Chef sous équipe',
        self::CHIEF_POLE    => 'Chef de pole',
        self::CHIEF_TEAM    => 'Chef d\'équipe',
        self::COORDINATOR   => 'Coordinateur',
        self::VOLONTARIA    => 'Volontariat',
    ];
}
