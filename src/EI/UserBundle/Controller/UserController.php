<?php

namespace EI\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use EI\UserBundle\Entity\FormRegister;


class UserController extends Controller{
     
    public function registerAction (Request $request)
    {
 
        return $this->render('EIUserBundle:User:register.html.twig');
    }
    
     public function loginAction (Request $request)
    {

    }
}
