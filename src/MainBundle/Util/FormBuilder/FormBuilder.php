<?php

namespace MainBundle\Util\FormBuilder;
use MainBundle\Entity\Event;
use MainBundle\Entity\Form;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use MainBundle\Util\ElementBuilder\ElementFactory;

class FormBuilder
{

    //http://symfony.com/doc/current/cookbook/controller/service.html
    private $templating;
    private $container;
    private $em;
    private $mapeo = [];
    private $unique;

    /**
     * Constructor
     * @param Container $container
     */
    public function __construct(Container $container, EngineInterface $templating)
    {
        $this->unique = uniqid();
        $this->templating = $templating;
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function displayForm(Event $event, Form $form)
    {

        $elementFactories = [];
        foreach($form->getElement() as $key => $element){

            $physicalTable = $this->em->getRepository('MainBundle:Form')->findOneFromPhysicalTable($event, $form, $element);
            if(!is_null($physicalTable) && array_key_exists("field", $physicalTable)) {
                $element->setTagValue($physicalTable['field']);
            }

            $elementFactories[] = ElementFactory::newInstance($form, $element);
        }

        return $this->templating->renderResponse(
            'BackendBundle:Form:displayForm.html.twig',
            array(
                'form' => $form,
                'elementFactories' => $elementFactories,
            )
        )->getContent();
    }



}