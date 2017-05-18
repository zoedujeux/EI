<?php

namespace EI\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;
use EI\AdminBundle\Entity\WhereTo;
use EI\AdminBundle\Form\WhereToType;

class WhereToController extends Controller
{
    
    public function viewWhereToAction($whereToId, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $whereTo = $em
                ->getRepository('EIAdminBundle:WhereTo')
                ->myFindOne($whereToId);

//        $listwhereTo = $this->getDoctrine()
//            ->getManager()
//            ->getRepository('EIAdminBundle:WhereTo')
//            ->findAll()
//          ;
     
        $form = $this->get('form.factory')->create(WhereToType::class, $whereTo);

        
        if ($form->handleRequest($request)->isValid()) {
             foreach ($whereTo->getBrs() as $br){
                 $br->addWhereTo($whereTo);
             }
           $em = $this->getDoctrine()->getManager();
            $em->persist($whereTo);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');
            
            return $this->redirect($this->generateUrl('ei_whereTo_viewWhereTo', array('whereToId' => $whereTo->getId())));
//            return $this->redirect($this->generateUrl('ei_whereTo_viewWhereTo', array('id' => $whereTo->getId())));
        }

        return $this->render('EIAdminBundle:Admin:addWhereTo.html.twig', array(
          'form' => $form->createView(),
          'whereTo'=> $whereTo,
//          'listwhereTo'=> $listwhereTo,
        ));   
    }
    
}
