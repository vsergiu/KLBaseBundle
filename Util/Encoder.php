<?php

namespace KL\BaseBundle\Util;

use Symfony\Component\Security\Core\User\UserInterface;

class Encoder
{  
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function encodePassword(UserInterface $user, $password)
    {
        $encoderFactory = $this->container->get('security.encoder_factory');
        $encoder = $encoderFactory->getEncoder($user);
        
        return $encoder->encodePassword($password, $user->getSalt());
    }
    
    public function generateSalt()
    {
        return base_convert(hash('sha512', uniqid(mt_rand())), 16, 36);
    }
}