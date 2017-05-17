<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventEditType extends AbstractType 
{
    public function getParent()
    {
      return EventType::class;
    }
}
