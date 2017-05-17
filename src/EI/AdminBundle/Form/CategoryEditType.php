<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryEditType extends AbstractType 
{
    public function getParent()
    {
      return CategoryType::class;
    }
}
