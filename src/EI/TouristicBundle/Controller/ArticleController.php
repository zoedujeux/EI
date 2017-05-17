<?php
namespace EI\TouristicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public function mailChimpAction(Request $request) {
        
//        $mailchimp = new MailChimp();
//        $form = $this->get('form.factory')->create(MailChimp::class, $mailchimp);
//             
//        if ($form->handleRequest($request)->isValid()) {
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($mailchimp);
//        $em->flush();
//
//        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');
//
//        return $this->redirect($this->generateUrl('EITouristicBundle::layout.html.twig', array('id' => $mailchimp->getId())));
//      }
//
//      return $this->render('EITouristicBundle::layout.html.twig', array(
//        'form' => $form->createView(),
//        'mailchimp' => $mailchimp,
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

//    public function commentAction(Request $request)
//    {
//        $id = 'thread_id';
//        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
//        if (null === $thread) {
//            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
//            $thread->setId($id);
//            $thread->setPermalink($request->getUri());
//
//            // Add the thread
//            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
//        }
//
//        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
//
//        return $this->render('EITouristicBundle:Article:viewMoreBR.html.twig', array(
//            'comments' => $comments,
//            'thread' => $thread,
//        ));
//    }

     public function indexAction()
    {

         $listHome= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Home')
            ->findAll()
          ;

         $listEvent = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Event')
            ->findAll()
          ;
         
         $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;
         
         
          return $this->render('EITouristicBundle:Article:index.html.twig', array (
              "listHome"    =>$listHome,
              "listEvent"    =>$listEvent,
              "image"    =>$image,

          ));

    }

    public function viewMoreEventAction($id)
    {
 
        $articleEvent = $this->getDoctrine()
           ->getManager()
           ->getRepository('EIAdminBundle:Event')
           ->find($id)
         ;
        
        $images = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
        ;
          return $this->render('EITouristicBundle:Article:viewMoreEvent.html.twig', array (
              "articleEvent"    =>$articleEvent,
               "images"    =>$images,
             
          ));

    }
    
    public function eatChoiceAction()
    {
         
         $listCategory= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->findAll()
          ;
         
         $listWhereTo= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:WhereTo')
            ->findAll()
        ;
         
          $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;
         
          return $this->render('EITouristicBundle:Article:eatChoice.html.twig', array (
              "listCategory"    =>$listCategory, 
              "listWhereTo"    =>$listWhereTo,
              "image"    =>$image,
          ));

    }
    
//    public function eatAction($category,$whereTo)
    public function eatAction()
    {
        
//        $category= $this->getDoctrine()
//            ->getManager()
//            ->getRepository('EIAdminBundle:Category')
//            ->find($id)
//          ;
       
         $listBR= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:BR')
//            ->getBRWithCategory(['category'=>$category])
            ->findAll()
          ;
         
//        $listBR= $this->getDoctrine()
//            ->getManager()
//            ->getRepository('EIAdminBundle:BR')
//            ->findAll()
//          ;
         
        $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;

          return $this->render('EITouristicBundle:Article:eat.html.twig', array (
//              "category"    =>$category,  
              "listBR"    =>$listBR,
              "image"    =>$image,
          ));

    }
    
     public function drinkChoiceAction()
    {
         
         $listCategory= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->findAll()
          ;
         
         $listWhereTo= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:WhereTo')
            ->findAll()
        ;
         
        $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;
         
          return $this->render('EITouristicBundle:Article:drinkChoice.html.twig', array (
              "listCategory"    =>$listCategory, 
              "listWhereTo"    =>$listWhereTo,
              "image"    =>$image,
          ));

    }
    
    public function drinkAction()
    {
         $listCategory= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->findAll()
          ;
         
         $listBR= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:BR')
            ->findAll()
          ;
        
        $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;

          return $this->render('EITouristicBundle:Article:drink.html.twig', array (
              "listCategory"    =>$listCategory,  
              "listBR"    =>$listBR,
              "image"    =>$image,
          ));

    }
    
    public function journeyChoiceAction()
    {
         
         $listCategory= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->findAll()
          ;
         
         $listWhereTo= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:WhereTo')
            ->findAll()
        ;
         
          $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;
         
          return $this->render('EITouristicBundle:Article:journeyChoice.html.twig', array (
              "listCategory"    =>$listCategory, 
              "listWhereTo"    =>$listWhereTo,
              "image"    =>$image,
          ));

    }
    

    public function journeyAction()
    {
        
        $listCategory= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->findAll()
          ;
       
         
        $listBR= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:BR')
            ->findAll()
          ;
         
        $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;

          return $this->render('EITouristicBundle:Article:journey.html.twig', array (
              "listCategory"    =>$listCategory,  
              "listBR"    =>$listBR,
              "image"    =>$image,
          ));

    }
    
     public function viewUserPageAction()
     {
          
         $listUserPage = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:UserPage')
            ->findAll()
          ;
         
          return $this->render('EITouristicBundle:Article:viewUserPage.html.twig', array (
              "listUserPage"    =>$listUserPage,

             
          ));
     }

    public function viewMoreBRAction($id, Request $request)
    {
 
        $articleBR = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:BR')
            ->findOneBy(['id'=>$id])
          ;
        
 
        $image = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Image')
            ->findAll()
          ;

        $id = 'thread_id';
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        
        return $this->render('EITouristicBundle:Article:viewMoreBR.html.twig', array (
            "articleBR"    =>$articleBR,
            "image"    =>$image,
            'comments' => $comments,
            'thread' => $thread,
        ));

    }
  
}