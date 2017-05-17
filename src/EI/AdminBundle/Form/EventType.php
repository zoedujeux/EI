<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
//use Symfony\Component\Form\Extension\Core\Type\ImageType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use EI\AdminBundle\Entity\Event;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title',     TextType::class)
                ->add('content',   TextareaType::class) 
                ->add('images', CollectionType::class, array(
                  'entry_type' => ImageType::class,
                  'allow_add'    => true,
                  'allow_delete'    => true
                    ))  
                ->add('save',      SubmitType::class)
                
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EI\AdminBundle\Entity\Event'
        ));
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function getBlockPrefix()
//    {
//        return 'ei_adminbundle_event';
//    }


}
