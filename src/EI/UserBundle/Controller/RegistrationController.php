<?php

namespace EI\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    public function RegistrationController(Request $request)
    {
        return $this->render('EIUserBundle:User:register.html.twig');
    }
}
