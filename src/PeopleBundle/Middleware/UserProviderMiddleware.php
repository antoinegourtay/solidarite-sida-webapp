<?php
namespace PeopleBundle\Middleware;

use EventBundle\Controller\EventController;
use PeopleBundle\Controller\PeopleController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UserProviderMiddleware implements EventSubscriberInterface
{
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($event->getController())) {
            return;
        }

        $controller = $event->getController()[0];
        if (
            !$controller instanceof PeopleController &&
            !$controller instanceof EventController
        ) {
            return;
        }

        $user = $controller->get('AuthenticationService')->isAuthenticated($controller->getRequest());
        $controller->get('CurrentUser')->set($user);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }
}
