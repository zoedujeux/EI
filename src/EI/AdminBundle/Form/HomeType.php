<?php

namespace EI\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;


class HomeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mainTitle',     TextType::class)
            ->add('content',  CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'label'             => 'Contenu',
                    'config_name'       => 'Ivory_config'
                ),
            ))
            ->add('events',  EntityType::class,['class'=>  \EI\AdminBundle\Entity\Event::class,'multiple'=>true])
           
            ->add('save',      SubmitType::class);
//        $builder
//            ->add('events', CollectionType::class, array(
//                  'entry_type' => EventType::class,
//                  'allow_add'    => true,
//                  'allow_delete'    => true
//                    ));
                
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EI\AdminBundle\Entity\Home'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ei_adminbundle_home';
    }


}
