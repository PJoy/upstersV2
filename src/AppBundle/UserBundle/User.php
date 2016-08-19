<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 16/08/2016
 * Time: 18:11
 */

namespace AppBundle\UserBundle;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}