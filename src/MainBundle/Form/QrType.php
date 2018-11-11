<?php

namespace MainBundle\Form;
use MainBundle\Entity\Category;

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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class QrType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function getChs() {
        $array['500x500'] = '500x500';
        $array['300x300'] = '300x300';
        $array['200x200'] = '200x200';

        return $array;
    }

    public function getChoe() {
        $array['UTF-8'] = 'UTF-8';
        $array['Shift_JIS'] = 'Shift_JIS';
        $array['ISO-8859-1'] = 'ISO-8859-1';

        return $array;
    }

    public function getChld() {
        $array['Allows recovery of up to 7% data loss'] = 'L';
        $array['Allows recovery of up to 15% data loss'] = 'M';
        $array['Allows recovery of up to 25% data loss'] = 'Q';
        $array['Allows recovery of up to 30% data loss'] = 'H';

        return $array;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('chl', TextType::class, array(
                'label'=>'Data',
                'label_attr' => array('class' => 'control-label'),
                'attr'       => array(
                                'class' => 'form-control col-md-1',
                                'placeholder' => 'data',
                                'required' => true,
                ),
                'error_bubbling' => true
            ))
            ->add('chs', ChoiceType::class, array(
//                'class' => 'MainBundle:Profile',
                'choices' => $this->getChs(),
//                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Tamaño',
                'label_attr' => array('class' => 'control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => '',
                ),
            ))
            ->add('choe', ChoiceType::class, array(
                'choices' => $this->getChoe(),
                'empty_data' => null,
                'label'=>'Encode',
                'label_attr' => array('class' => 'control-label'),
                'attr'       => array(
                    'class' => 'form-control col-md-1',
                    'placeholder' => '',
                ),
            ))
            ->add('chld', ChoiceType::class, array(
                'choices' => $this->getChld(),
                'empty_data' => null,
                'label'=>'Niveles de corrección de errores',
                'label_attr' => array('class' => 'control-label'),
                'attr'       => array(
                    'class' => 'form-control',
                    'placeholder' => '',
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
            'data_class' => 'MainBundle\Entity\Qr',

        ));
    }

}
