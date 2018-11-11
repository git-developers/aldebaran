<?php

namespace MainBundle\Form;

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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class NewsType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getFiles() {
        $model = $this->em->getRepository('MainBundle:Files')->findAll();
        return $model;
    }

    public function getNewsStatus() {
        $array['Publicado'] = 'published';
        $array['No publicado'] = 'unpublished';

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
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'Titulo 1',
                ),
            ))
            ->add('body', TextareaType::class, array(
                'label'=>'Body',
//                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'body',
                ),
            ))
            ->add('newsDate', DateType::class, array(
                'label'=>'Fecha de la noticia',
//                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'placeholder' => 'Select a value',
                'label_attr' => array('class' => 'col-sm-4 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'Fecha del news',
                ),
            ))
            ->add('files', EntityType::class, array(
                'class' => 'MainBundle:Files',
                'choices' => $this->getFiles(),
                'label'=>'fileId',
                'required'=> false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'style' => 'display:none',
                ),
            ))
            ->add('fileName', TextType::class, array(
                'label'=>'fileName',
                'required'=> false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'readonly'=>'readonly',
                    'placeholder' => 'nombre del archivo...',
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

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();

            if ($this->container->get('security.authorization_checker')->isGranted('ROLE_CHANGE_NEWS_STATUS')) {

                $form->add('newsStatus', ChoiceType::class, array(
                        'choices' => $this->getNewsStatus(),
                        //'class' => 'MainBundle:Permission',
                        'empty_data' => null,
                        'multiple' => false,
                        'expanded' => false,
                        'label'=>'Posicion',
                        'label_attr' => array('class' => 'col-sm-4 control-label'),
                        'attr'       => array(
                            'class' => 'form-control',
                            'placeholder' => '',
                        ),
                ));
            }
        });





    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\News',

        ));
    }


}
