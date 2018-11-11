<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PermissionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label'=>'Nombre',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar',
                'attr'       => array(
                    'class' => 'btn btn-info pull-right',
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Permission'
        ));
    }
}
