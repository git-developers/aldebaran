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


class FloorPlanType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getEvents() {
        $model = $this->em->getRepository('MainBundle:Event')->findAll();
        return $model;

        /*
        'choices' => $this->getEvents(),
        'multiple' => true,
         */
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->container->get('doctrine')->getManager();

        $builder
            ->add('name', TextType::class, array(
                'label'=>'name',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'title',
                ),
            ))
            ->add('event', EntityType::class, array(
                'class' => 'MainBundle:Event',
                'required' => false,
                'label' => false,
                'attr' => array(
//                    'style' => 'display:none;',
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar',
                'attr'       => array(
                    'class' => 'btn btn-block bg-primary',
                ),
            ));


        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();
            //$ubigeo = ($data['ubigeo']) ? $data['ubigeo'] : null;

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
            'data_class' => 'MainBundle\Entity\FloorPlan',

        ));
    }


}
