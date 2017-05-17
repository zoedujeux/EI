<?php

namespace EI\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;
use EI\AdminBundle\Entity\Home;
use EI\AdminBundle\Form\HomeType;
use EI\AdminBundle\Entity\HomeEdit;
use EI\AdminBundle\Form\HomeEditType;
use EI\AdminBundle\Entity\WhereTo;
use EI\AdminBundle\Form\WhereToType;
use EI\AdminBundle\Entity\BR;
use EI\AdminBundle\Entity\BREdit;
use EI\AdminBundle\Form\BRType;
use EI\AdminBundle\Form\BREditType;
use EI\AdminBundle\Entity\UserPage;
use EI\AdminBundle\Form\UserPageType;
use EI\AdminBundle\Entity\UserPageEdit;
use EI\AdminBundle\Form\UserPageEditType;
use EI\AdminBundle\Entity\Event;
use EI\AdminBundle\Form\EventType;
use EI\AdminBundle\Entity\EventEdit;
use EI\AdminBundle\Form\EventEditType;
use EI\AdminBundle\Entity\Image;
use EI\AdminBundle\Entity\Favorites;
use EI\AdminBundle\Entity\Comment;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('EIAdminBundle:Admin:index.html.twig');
    }
    
     public function viewHomeAction()
    {  
         $listHome = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Home')
            ->findAll()
          ;

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
        return $this->render('EIAdminBundle:Admin:viewHome.html.twig', array(
          'listHome'       => $listHome,
        ));
        
    }
    
     //**********************************************************
    //****ADD*************************************************
    //**********************************************************
    
    public function addHomeAction(Request $request)
    {
        $home = new Home();
//        $event = new Event();
        $form = $this->get('form.factory')->create(HomeType::class, $home);
        
      
        if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($home);
//        $em->persist($event);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');

        return $this->redirect($this->generateUrl('ei_admin_viewHome', array('id' => $home->getId())));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('EIAdminBundle:Admin:addHome.html.twig', array(
        'form' => $form->createView(),
        'home' => $home,
//        'event' => $event
      ));
    }
    
    //**********************************************************
    //****EDIT*************************************************
    //**********************************************************
    
    public function editHomeAction($id, Request $request)
    {
        // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $home = $em->getRepository('EIAdminBundle:Home')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($home == null) {
        throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
      }
      // Ici, on s'occupera de la création et de la gestion du formulaire
        $form = $this->get('form.factory')->create(HomeEditType::class, $home);

        if ($form->handleRequest($request)->isValid()) {
            
            foreach ($home->getEvents() as $event){
                $event->setHome($home);
            }
            
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

          return $this->redirect($this->generateUrl('ei_admin_viewHome', array('id' => $home->getId())));
        }

      // Ici, on s'occupera de la création et de la gestion du formulaire

      return $this->render('EIAdminBundle:Admin:editHome.html.twig', array(
        'form'   => $form->createView(),
        'home' => $home
      ));
    }
    
    //**********************************************************
    //****DELETE*************************************************
    //**********************************************************
    public function deleteHomeAction($id, Request $request)
    {
        // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $home = $em->getRepository('EIAdminBundle:Home')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($home == null) {
        throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
      }
      
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();

        if ($form->handleRequest($request)->isValid()) {
          $em->remove($home);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");

          return $this->redirect($this->generateUrl('ei_admin_viewHome'));
        }

      // Si la requête est en GET, on affiche une page de confirmation avant de delete
      return $this->render('EIAdminBundle:Admin:deleteHome.html.twig', array(
         'home' => $home,
         'form'=> $form->createView()
      ));
    }


//**********************************************************
//**********************************************************
//**********************************************************
//****BAR RESTAURANT ****************************************
//**********************************************************
//**********************************************************
//**********************************************************
    
       
    public function viewBRAction()
    {  
         $listBR = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:BR')
            ->findAll()
          ;


        // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
        return $this->render('EIAdminBundle:Admin:viewBR.html.twig', array(
            'listBR'       => $listBR,
        ));
        
    }
    
    
    
     //**********************************************************
    //****ADD*************************************************
    //**********************************************************
    public function addBRAction(Request $request)
    {         
        $br = new BR();
        $form = $this->get('form.factory')->create(BRType::class, $br);

      if ($form->handleRequest($request)->isValid()) {
        foreach ($br->getImages() as $image){
               $image->setBr($br);
           }
        $em = $this->getDoctrine()->getManager();
        $em->persist($br);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');

        return $this->redirect($this->generateUrl('ei_admin_viewBR', array('id' => $br->getId())));
      }

      return $this->render('EIAdminBundle:Admin:addBR.html.twig', array(
        'form' => $form->createView(),
        'br' => $br,
      ));
        
    }
    
    
    
     //**********************************************************
    //****EDIT*************************************************
    //**********************************************************
    
    public function editBRAction($id, Request $request)
    {
      // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();


      $br = $em->getRepository('EIAdminBundle:BR')->find($id);

      

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($br == null) {
        throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
      }
      // Ici, on s'occupera de la création et de la gestion du formulaire
        $form = $this->get('form.factory')->create(BREditType::class, $br);

        if ($form->handleRequest($request)->isValid()) {            
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

          return $this->redirect($this->generateUrl('ei_admin_viewBR', array('id' => $br->getId())));
        }

      

      return $this->render('EIAdminBundle:Admin:editBR.html.twig', array(
        'form'   => $form->createView(),
        'br' => $br,
          
      ));
    }
    
    
    //**********************************************************
    //****DELETE*************************************************
    //**********************************************************
    public function deleteBRAction($id,Request $request)
    {
      // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $br = $em->getRepository('EIAdminBundle:BR')->find($id);
      

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($br == null) {
        throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
      }
      
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
          $em->remove($br);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "Bien été supprimée.");

          return $this->redirect($this->generateUrl('ei_admin_viewBR'));
        }

      // Si la requête est en GET, on affiche une page de confirmation avant de delete
      return $this->render('EIAdminBundle:Admin:deleteBR.html.twig', array(
          'br' => $br,
         'form'=> $form->createView()
      ));
    }
//**********************************************************
//**********************************************************
//**********************************************************
//****USER PAGE****************************************
//**********************************************************
//**********************************************************
//**********************************************************
    
     public function viewUserPageAction()
    {
         $listUserPage = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:UserPage')
            ->findAll()
          ;

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
        return $this->render('EIAdminBundle:Admin:viewUserPage.html.twig', array(
          'listUserPage'       => $listUserPage,
        ));
  
    }
    
    //**********************************************************
    //****ADD*************************************************
    //**********************************************************
    
    public function addUserPageAction(Request $request)
    {
        $userPage = new UserPage();
        $form = $this->get('form.factory')->create(UserPageType::class, $userPage);

        if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($userPage);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');

        return $this->redirect($this->generateUrl('ei_admin_viewUserPage', array('id' => $userPage->getId())));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('EIAdminBundle:Admin:addUserPage.html.twig', array(
        'form' => $form->createView(),
        'userPage' => $userPage,
      ));
    }
    
    //**********************************************************
    //****EDIT*************************************************
    //**********************************************************
    
    public function editUserPageAction($id, Request $request)
    {
      // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $userPage = $em->getRepository('EIAdminBundle:UserPage')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($userPage == null) {
        throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
      }
      // Ici, on s'occupera de la création et de la gestion du formulaire
        $form = $this->get('form.factory')->create(UserPageEditType::class, $userPage);

        if ($form->handleRequest($request)->isValid()) {
          // Inutile de persister ici, Doctrine connait déjà notre annonce
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

          return $this->redirect($this->generateUrl('ei_admin_viewUserPage', array('id' => $userPage->getId())));
        }

      // Ici, on s'occupera de la création et de la gestion du formulaire

      return $this->render('EIAdminBundle:Admin:editUserPage.html.twig', array(
        'form'   => $form->createView(),
        'userPage' => $userPage,
      ));
    }
    
    
    //**********************************************************
    //****DELETE*************************************************
    //**********************************************************
    public function deleteUserPageAction($id, Request $request)
    {
      // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $userPage = $em->getRepository('EIAdminBundle:UserPage')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($userPage == null) {
        throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
      }
      
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
          $em->remove($userPage);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");

          return $this->redirect($this->generateUrl('ei_admin_viewUserPage'));
        }

      // Si la requête est en GET, on affiche une page de confirmation avant de delete
      return $this->render('EIAdminBundle:Admin:deleteUserPage.html.twig', array(
         'userPage' => $userPage,
         'form'=> $form->createView()
      ));
    }

//**********************************************************
//**********************************************************
//**********************************************************
//***EVENTS****************************************
//**********************************************************
//**********************************************************
//**********************************************************
    
     public function viewEventAction()
    {  
         $listEvent = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Event')
            ->findAll()
          ;

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
        return $this->render('EIAdminBundle:Admin:viewEvent.html.twig', array(
          'listEvent'       => $listEvent,
        ));
        
    }
    
     //**********************************************************
    //****ADD*************************************************
    //**********************************************************
    
    public function addEventAction(Request $request)
    {
        $event = new Event();
        $form = $this->get('form.factory')->create(EventType::class, $event);

        if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');

        return $this->redirect($this->generateUrl('ei_admin_viewEvent', array('id' => $event->getId())));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('EIAdminBundle:Admin:addEvent.html.twig', array(
        'form' => $form->createView(),
        'event' => $event
      ));
    }
    
    //**********************************************************
    //****EDIT*************************************************
    //**********************************************************
    
    public function editEventAction($id, Request $request)
    {
        // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $event = $em->getRepository('EIAdminBundle:Event')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($event == null) {
        throw $this->createNotFoundException("L'évenement d'id ".$id." n'existe pas.");
      }
      // Ici, on s'occupera de la création et de la gestion du formulaire
        $form = $this->get('form.factory')->create(EventEditType::class, $event);

        if ($form->handleRequest($request)->isValid()) {
          // Inutile de persister ici, Doctrine connait déjà notre annonce
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Bien modifiée.');

          return $this->redirect($this->generateUrl('ei_admin_viewEvent', array('id' => $event->getId())));
        }

      // Ici, on s'occupera de la création et de la gestion du formulaire

      return $this->render('EIAdminBundle:Admin:editEvent.html.twig', array(
        'form'   => $form->createView(),
        'event' => $event
      ));
    }
    
    //**********************************************************
    //****DELETE*************************************************
    //**********************************************************
    public function deleteEventAction($id, Request $request)
    {
        // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $event = $em->getRepository('EIAdminBundle:Event')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($event == null) {
        throw $this->createNotFoundException("L'évenement d'id ".$id." n'existe pas.");
      }
      
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();

        if ($form->handleRequest($request)->isValid()) {
          $em->remove($event);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "Bien été supprimée.");

          return $this->redirect($this->generateUrl('ei_admin_viewEvent'));
        }

      // Si la requête est en GET, on affiche une page de confirmation avant de delete
      return $this->render('EIAdminBundle:Admin:deleteEvent.html.twig', array(
         'event' => $event,
         'form'=> $form->createView()
      ));
    }
    
}
