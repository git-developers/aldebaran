<?php

namespace MainBundle\Form;
use MainBundle\Entity\Company;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class UserType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getProfile() {
        $model = $this->em->getRepository('MainBundle:Profile')->findAll();
        return $model;
    }

    public function getDeviceOs() {
        $array['ANDROID'] = 'ANDROID';
        $array['OS'] = 'OS';

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
            ->add('deviceCode', TextType::class, array(
                'label'=>'Device code',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'Device code',
                ),
            ))
            ->add('deviceOs', ChoiceType::class, array(
                'choices' => $this->getDeviceOs(),
//                'class' => 'MainBundle:Permission',
                'empty_data' => null,
                'multiple' => false,
                'expanded' => false,
                'label'=>'Device Os',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => '',
                ),
            ))
            ->add('password', PasswordType::class, array(
                'label'=>'Password',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'password',
                ),
            ))
            ->add('phone', IntegerType::class, array(
                'label'=>'Telefono',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'ingrese el telefono del usuario',
                ),
                'error_bubbling' => true
            ))
            ->add('dob', BirthdayType::class, array(
                'label'=>'Fecha de nacimiento',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'format' => 'dd-MM-yyyy',
                'years' => range(date('Y') -18, date('Y') -80),
                'placeholder' => array(
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
                ),
                'attr'       => array(
                                'class' => 'form-control',
                ),
                'error_bubbling' => false
            ))
            ->add('username', TextType::class, array(
                'label'=>'Username',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control',
                                'placeholder' => 'username',
                ),
                'error_bubbling' => true
            ))
            ->add('dni', TextType::class, array(
                'label'=>'Dni',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                                'class' => 'form-control required',
                                'placeholder' => 'dni (8 caracteres)',
                                'pattern'=>'[0-9]{8}',
                                'maxlength'=>'8',
                                'minlength'=>'8',
                                'form'=>'user-form',
                ),
                'error_bubbling' => true
            ))
            ->add('name', TextType::class, array(
                'label'=>'Nombres',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control required',
                    'placeholder' => 'nombres',
                ),
            ))
            ->add('lastName', TextType::class, array(
                'label'=>'Apellidos',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control required',
                    'placeholder' => 'apellidos',
                ),
            ))
            ->add('email', EmailType::class, array(
                'label'=>'email',
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control required',
                    'placeholder' => 'test@test.com',
                ),
                //'error_bubbling' => true
            ))
            ->add('profile', EntityType::class, array(
                'class' => 'MainBundle:Profile',
                'choices' => $this->getProfile(),
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Perfil',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control required',
                    'placeholder' => 'perfil',
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
            //$ubigeo = ($data['ubigeo']) ? $data['ubigeo'] : null;
            //$provinciaId = ($data['provincia']) ? $data['provincia'] : null;



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

                if ($provinciaId) {
                    $provincia = $em->getRepository('OverallSSRICoreBundle:Ubigeo')->find($provinciaId);
                    $distritos = $this->getDistritos($departamento->getCoddpto(), $provincia->getCodprov());
                    $form->add('distrito', 'entity', array(
                        'attr'=> array('class'=>'form-control'),
                        'class' => 'OverallSSRICoreBundle:Ubigeo',
                        'required' => true,
                        'choices' => $distritos,
                        'empty_value' => '[ Seleccione ]'
                    ));
                }
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
            'data_class' => 'MainBundle\Entity\User',
//            'cascade_validation' => true,

        ));
    }




    /*
            ->add('tCompany', 'entity', array(
                'label'=>'Empresa',
                'class' => 'MainBundle:TCompany',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => 'empresa',
                ),
            ))
     */



}
