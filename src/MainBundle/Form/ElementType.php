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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class ElementType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getElements() {
        $model = $this->em->getRepository('MainBundle:Element')->findAll();
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
            ->add('idIncrement', HiddenType::class, array(
                'required' => true,
            ))
            ->add('labelName', TextType::class, array(
                'label'=>'etiqueta',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'nombre con el que mostrara',
                ),
            ))
            ->add('tagValue', TextType::class, array(
                'label'=>'valor por defecto',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'se mostrara al inicio',
                ),
            ))
            ->add('tagMin', IntegerType::class, array(
                'label'=>'# min caracteres',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'mínimo',
                ),
            ))
            ->add('tagMax', IntegerType::class, array(
                'label'=>'# max caracteres',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'máximo',
                ),
            ))
            ->add('tagPlaceholder', TextType::class, array(
                'label'=>'placeholder',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'información del input',
                ),
            ))
            ->add('tagMaxlength', IntegerType::class, array(
                'label'=>'cantidad de caracteres',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'que se puede ingresar',
                ),
            ))
            ->add('tagRequired', CheckboxType::class, array(
                'label'=>'obligatorio',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => '',
                    'style' => 'height:20px; width:20px;margin-left:10px',
                    'placeholder' => '',
                ),
            ))
            ->add('tagDisabled', CheckboxType::class, array(
                'label'=>'deshabilitado',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => '',
                    'style' => 'height:20px; width:20px;margin-left:10px',
                    'placeholder' => '',
                ),
            ))
            ->add('tagReadonly', CheckboxType::class, array(
                'label'=>'solo lectura',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => '',
                    'style' => 'height:20px; width:20px;margin-left:10px',
                    'placeholder' => '',
                ),
            ))
            ->add('submit', ButtonType::class, array(
                'label' => 'aplicar',
                'attr'       => array(
                    'class' => 'btn btn-block bg-orange ', //btn-lg
                ),
            ));

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();

            /*
            if ($departamentoId) {
                $departamento = $em->getRepository('OverallSSRICoreBundle:Ubigeo')->find($departamentoId);
                $provincias = $this->getProvincias($departamento->getCoddpto());
                $form->add('provincia', 'entity', array(
                    'attr'=> array('class'=>'form-control'),
                    'class' => 'OverallSSRICoreBundle:Ubigeo',
                    'required' => true,
                    'choices' => $provincias,
                    'empty_value' => '[ Seleccione ]'
                ));
            }
            */

        });

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Element',

        ));
    }


}
