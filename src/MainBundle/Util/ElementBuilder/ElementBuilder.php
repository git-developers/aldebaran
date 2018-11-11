<?php

namespace MainBundle\Util\ElementBuilder;
use MainBundle\Entity\Form;
use MainBundle\Entity\Element;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class ElementBuilder
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

    public function displayElement(Form $form, Element $element)
    {
        if($element->getIdIncrement() > 0) {
            return $this->display($form, $element);
        }else{
            return $this->error();
        }
    }

    public function display(Form $form, Element $element)
    {

        return $this->templating->renderResponse(
            'BackendBundle:Element:displayFormElement.html.twig',
            array(
                'element' => ElementFactory::newInstance($form, $element),
            )
        )->getContent();
    }

    public function error()
    {

        return $this->templating->renderResponse(
            'BackendBundle:Element:error.html.twig',
            array(
                'elementFactory' => '',
            )
        )->getContent();
    }


}