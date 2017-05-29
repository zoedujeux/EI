<?php
namespace EI\TouristicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
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
    
    public function whereToAction($whereToId)
    {
         $whereTo  = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:WhereTo')
            ->myFindOne($whereToId)
          ;
         
         $listCategoryWithWhereTo = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:WhereTo')
            ->getWhereToWithCategory()
          ;
         
          return $this->render('EITouristicBundle:Article:whereToView.html.twig', array (
              "whereTo"    =>$whereTo, 
              "listCategoryWithWhereTo"    =>$listCategoryWithWhereTo,
          ));
        
    }
    
    public function categoryAction($id)
    {
         
        $category= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->myFindOne($id)
        ;
         
        $listBrWithCategory= $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->getCategoryWithBR()
        ;
         
          return $this->render('EITouristicBundle:Article:category.html.twig', array (
              "category"    =>$category,
              "listBrWithCategory"    =>$listBrWithCategory,
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
    
//    public function translationAction($name)
//    {
//      return $this->render('EITouristicBundle:Article:translation.html.twig', array(
//        'name' => $name
//      ));
//    }
  
}