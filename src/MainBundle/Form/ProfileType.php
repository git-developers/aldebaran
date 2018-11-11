<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProfileType extends AbstractType
{
    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getPermission() {
        $model = $this->em->getRepository('MainBundle:Permission')->findAll();
        return $model;
    }

    public function getPermission2() {
        $model = $this->em->getRepository('MainBundle:Permission')->findAll();

        $out = [];
        foreach($model as $key => $value){
            $out[$value->getName()] = $value->getIdIncrement();
        }

        return $model;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //ChoiceType::class
        $builder
            ->add('name', null, array(
                'label'=>'Nombre del perfil',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ),
            ))
            ->add('permission', EntityType::class, array(
                'choices' => $this->getPermission(),
                'class' => 'MainBundle:Permission',
                'empty_data' => null,
                'multiple' => true,
                'expanded' => true,
                'label'=>'Permisos del perfil',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => '',
                    'style' => 'display:none;',
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar',
                'attr'       => array(
                    'class' => 'btn btn-info pull-right',
                ),
            ))
        ; //EntityType
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Profile'
        ));
    }



    /*
     ->add('permission', CheckboxType::class, array(
                'data' => $this->getPermission(),
                'empty_data' => null,
                'property_path' => '[idIncrement]',
                'data_class' => 'MainBundle\Entity\Permission',
                'label'=>'Permisos del perfil',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'permission',
                ),
        ))


    ->add('permission', EntityType::class, array(
        'choices' => $this->getPermission(),
        'class' => 'MainBundle:Permission',
        'empty_data' => null,
        'multiple' => true,
        'label'=>'Permisos del perfil',
        'label_attr' => array('class' => 'col-sm-2 control-label'),
        'attr'       => array(
            'class' => 'form-control',
            'placeholder' => 'permission',
        ),
    ))
     */

}
