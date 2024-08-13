<?php

namespace App\EventListener;

// src/App/EventListener/AuthenticationSuccessListener.php

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
//use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener {
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $data['user'] = array(
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email'  => $user->getEmail(),
            'photo'  =>  $user->getPhoto(),
            'createdAt' =>  $user->getCreatedAt()->format('Y-m-d'),
            'roles'  =>  $user->getRoles()
        );

        $event->setData($data);
    }
}