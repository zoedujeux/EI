<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
//use Symfony\Component\Form\Extension\Core\Type\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;


class BRType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title',     TextType::class)
                ->add('content',    CKEditorType::class, array(
                        'config' => array(
                            'uiColor' => '#ffffff',
                            'label'             => 'Contenu',
                            'config_name'       => 'Ivory_config'
                        ),
                    )) 
                ->add('images', CollectionType::class, array(
                  'entry_type' => ImageType::class,
                  'allow_add'    => true,
                  'allow_delete'    => true
                    ))
                ->add('categories',  EntityType::class,['class'=>  \EI\AdminBundle\Entity\Category::class,'multiple'=>true])
//                CKEDITOR A AJOUTER PAR LA SUITE
//                ->add('content','ckeditor', array(
//                'label'             => 'Contenu',
//                'config_name'       => 'Ivory_config'
//            ))
                ->add('save',      SubmitType::class)
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EI\AdminBundle\Entity\BR'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ei_adminbundle_br';
    }


}
