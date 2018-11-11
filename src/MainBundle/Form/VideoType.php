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


class VideoType extends AbstractType
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

    public function getAccess() {
        $array['Privado'] = 'private';
        $array['Publico'] = 'public';

        return $array;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->container->get('doctrine')->getManager();

        $builder
            ->add('title', TextType::class, array(
                'label'=>'Titulo',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control youtube-api',
                                'placeholder' => 'title',
                ),
            ))
            ->add('body', TextareaType::class, array(
                'label'=>'Body',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control youtube-api',
                                'placeholder' => 'body',
                ),
            ))
            ->add('access', ChoiceType::class, array(
                'choices' => $this->getAccess(),
                'label'=>'Acceso',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('youtubeUrl', TextType::class, array(
                'label'=>'Url',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-1 control-label'),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'coloque el url de un video youtube',
                ),
            ))
            ->add('youtubeId', TextType::class, array(
                'label'=>'youtubeId',
                'required' => true,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array(
                    'class' => 'form-control youtube-api',
                    'placeholder' => '',
                    'style' => 'display:none;',
                ),
            ))
            ->add('youtubeThumbnail', TextType::class, array(
                'label'=>'youtubeThumbnail',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array(
                    'class' => 'form-control youtube-api',
                    'placeholder' => '',
                    'style' => 'display:none;',
                ),
            ))
            ->add('youtubeDuration', TextType::class, array(
                'label'=>'youtubeDuration',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array(
                    'class' => 'form-control youtube-api',
                    'placeholder' => '',
                    'style' => 'display:none;',
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
            'data_class' => 'MainBundle\Entity\Video',

        ));
    }


}
