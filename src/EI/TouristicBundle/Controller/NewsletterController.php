<?php

namespace EI\TouristicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class NewsletterController extends Controller{
    
   public function mailChimpAction(Request $request) {
        
        $mailchimp = new MailChimp();
        $form = $this->get('form.factory')->create(MailChimp::class, $mailchimp);
             
        if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($mailchimp);
        $em->flush();
//
//        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');
//
//        return $this->redirect($this->generateUrl('EITouristicBundle::layout.html.twig', array('id' => $mailchimp->getId())));
      
        return new JsonResponse(array('message' => 'Success!'), 200);
        }
        
        $response = new JsonResponse(
            array(
        'message' => 'Error',
        'form' => $this->renderView('EITouristicBundle:Article:form.html.twig',
                array(
            'mailchimp' => $mailchimp,
            'form' => $form->createView(),
        ))), 400);
 
        return $response;
      
//      if ( $request->isMethod( 'POST' ) ) 
//          { 
//            $form->bind( $request );
//
//            if ( $form->isValid( ) ) {
//
//              /*
//               * $data['title']
//               * $data['body']
//               */
//              $data = $form->getData();
//
//              $response['success'] = true;
//
//            }else{
//
//              $response['success'] = false;
//              $response['cause'] = 'whatever';
//
//            }
//
//            return new JsonResponse( $response );
//          }

//      return $this->render('EITouristicBundle::layout.html.twig', array(
//        'form' => $form->createView(),
//        'mailchimp' => $mailchimp,
//        'data' => $data,
//      ));
//        
//        $mc = $this->get('hype_mailchimp');
//        $data = $mc->getList()
//                   ->addMerge_vars(
//                           array(
//                               'mc_notes' => 'test notes'
//                   ))
//                   ->subscribe('moneky@monkiesInSuites.com');
//           var_dump($data);
        
//        $listMailChimp = $this->getDoctrine()
//            ->getManager()
//            ->getRepository('EIAdminBundle:MailChimp')
//            ->findAll()
//          ;
//        
//        return $this->render('EITouristicBundle:Article:index.html.twig', array (
//              "listMailChimp"    =>$listMailChimp,
//          ));
    }
}
