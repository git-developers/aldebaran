<?php

namespace MainBundle\Form;
use MainBundle\Entity\Company;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class GcmType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getUser() {
        $model = $this->em->getRepository('MainBundle:User')->findAll();
        return $model;
    }

    public function getSound() {
        $o['default'] = 'default';
        $o['beep.caf'] = 'beep.caf';
        return $o;
    }

    public function getColor() {
        $o['#F44336'] = '#F44336';
        $o['#7DED32'] = '#7DED32';
        return $o;
    }

    public function getIcon() {
        $o['ico_notification'] = 'ico_notification';
        return $o;
    }

    public function getClickAction() {
        $o['OPEN_ACTIVITY_1'] = 'OPEN_ACTIVITY_1';
        return $o;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('user', EntityType::class, array(
                'class' => 'MainBundle:User',
                'choices' => $this->getUser(),
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Usuario',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'usuario',
                ),
            ))
            ->add('clickAction', ChoiceType::class, array(
                'choices' => $this->getClickAction(),
                //'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Action al dar click a la notificacion',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'sound',
                ),
            ))
            ->add('color', ChoiceType::class, array(
                'choices' => $this->getColor(),
                //'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Color',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'color',
                ),
            ))
            ->add('sound', ChoiceType::class, array(
                'choices' => $this->getSound(),
                //'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Sound',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'sound',
                ),
            ))
            ->add('icon', ChoiceType::class, array(
                'choices' => $this->getIcon(),
                //'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Icono',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'sound',
                ),
            ))
            ->add('badge', TextType::class, array(
                'label'=>'Badge',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'badge',
                ),
                'error_bubbling' => true
            ))
            ->add('title', TextType::class, array(
                'label'=>'Title',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'title',
                ),
                'error_bubbling' => true
            ))
            ->add('body', TextareaType::class, array(
                'label'=>'Body',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'body',
                ),
                'error_bubbling' => true
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
            'data_class' => 'MainBundle\Entity\Gcm',

        ));
    }


}
