<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class HomeEditType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//      $builder->remove('date');
//    }
    
    public function getParent()
    {
      return HomeType::class;
    }
    
//    public function getName()
//    {
//        return 'ei_adminbundle_homeedit';
//    }
  
}
