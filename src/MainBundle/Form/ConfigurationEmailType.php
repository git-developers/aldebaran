<?php

namespace MainBundle\Form;
use MainBundle\Entity\Configuration;

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


class ConfigurationEmailType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getDocument() {
        $model = $this->em->getRepository('MainBundle:Document')->findAll();
        return $model;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->container->get('doctrine')->getManager();

        $builder
            ->add('fromName', TextType::class, array(
                'label'=>'Nombre (from)',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'sineacor, nombre del usuario',
                ),
            ))
            ->add('fromEmail', EmailType::class, array(
                'label'=>'Email (from)',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'test@sineacor.com, email principal',
                ),
            ))
            ->add('username', TextType::class, array(
                'label'=>'Username',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'test@gmail.com',
                ),
            ))
            ->add('password', TextType::class, array(
                'label'=>'Password',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'password del username',
                ),
            ))
            ->add('host', TextType::class, array(
                'label'=>'Host',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'smtp.gmail.com',
                ),
            ))
            ->add('port', NumberType::class, array(
                'label'=>'Port',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => '587',
                ),
            ))
            ->add('encryption', TextType::class, array(
                'label'=>'Encryption',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'tls, ssl',
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar',
                'attr'       => array(
                    'class' => 'btn btn-info pull-right',
                ),
            ));


        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();

        });


    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\ConfigurationEmail',

        ));
    }


}
