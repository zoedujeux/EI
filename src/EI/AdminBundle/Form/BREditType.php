<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class BREditType extends AbstractType 
{
     public function getParent()
    {
      return BRType::class;
    }
}
