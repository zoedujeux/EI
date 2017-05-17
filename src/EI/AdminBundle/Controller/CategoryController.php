<?php

namespace EI\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;
use EI\AdminBundle\Entity\Category;
use EI\AdminBundle\Form\CategoryType;
use EI\AdminBundle\Entity\CategoryEdit;
use EI\AdminBundle\Form\CategoryEditType;

class CategoryController extends Controller
{
     public function viewCategoryAction()
    {  
         $listCategory = $this->getDoctrine()
            ->getManager()
            ->getRepository('EIAdminBundle:Category')
            ->findAll()
          ;

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
        return $this->render('EIAdminBundle:Admin:viewCategory.html.twig', array(
          'listCategory'       => $listCategory,
        ));
        
    }
    
     //**********************************************************
    //****ADD*************************************************
    //**********************************************************
    
    public function addCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->get('form.factory')->create(CategoryType::class, $category);

        if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', ' Bien ajouté.');

        return $this->redirect($this->generateUrl('ei_category_viewCategory', array('id' => $category->getId())));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('EIAdminBundle:Admin:addCategory.html.twig', array(
        'form' => $form->createView(),
        'category' => $category
      ));
    }
    
    //**********************************************************
    //****EDIT*************************************************
    //**********************************************************
    
    public function editCategoryAction($id, Request $request)
    {
        // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $category = $em->getRepository('EIAdminBundle:Category')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($category == null) {
        throw $this->createNotFoundException("La catégorie d'id ".$id." n'existe pas.");
      }
      // Ici, on s'occupera de la création et de la gestion du formulaire
        $form = $this->get('form.factory')->create(CategoryEditType::class, $category);

        if ($form->handleRequest($request)->isValid()) {
          // Inutile de persister ici, Doctrine connait déjà notre annonce
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

          return $this->redirect($this->generateUrl('ei_category_viewCategory', array('id' => $category->getId())));
        }

      // Ici, on s'occupera de la création et de la gestion du formulaire

      return $this->render('EIAdminBundle:Admin:editCategory.html.twig', array(
        'form'   => $form->createView(),
        'category' => $category
      ));
    }
    
    //**********************************************************
    //****DELETE*************************************************
    //**********************************************************
    public function deleteCategoryAction($id, Request $request)
    {
        // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // On récupère l'entité correspondant à l'id $id
      $category = $em->getRepository('EIAdminBundle:Category')->find($id);

      // Si l'annonce n'existe pas, on affiche une erreur 404
      if ($category == null) {
        throw $this->createNotFoundException("La catégorie d'id ".$id." n'existe pas.");
      }
      
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();

        if ($form->handleRequest($request)->isValid()) {
          $em->remove($category);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "La catégorie a bien été supprimée.");

          return $this->redirect($this->generateUrl('ei_category_viewCategory'));
        }

      // Si la requête est en GET, on affiche une page de confirmation avant de delete
      return $this->render('EIAdminBundle:Admin:deleteCategory.html.twig', array(
         'category' => $category,
         'form'=> $form->createView()
      ));
    }
   
}
