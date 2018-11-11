<?php

namespace MainBundle\Util\FloorplanBuilder;
use MainBundle\Entity\FloorPlan;
use MainBundle\Entity\Element;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class FloorplanBuilder
{

    //http://symfony.com/doc/current/cookbook/controller/service.html
    private $templating;
    private $container;
    private $em;
    private $mapeo = [];
    private $unique;
    private $symbolRoute;

    /**
     * Constructor
     * @param Container $container
     */
    public function __construct(Container $container, EngineInterface $templating)
    {
        $this->unique = uniqid();
        $this->templating = $templating;
        $this->container = $container;
        $this->symbolRoute = '/'.$this->container->getParameter('project_folder').'/web/bundles/backend/images/symbols/';
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function displayElement(FloorPlan $form, Element $element)
    {
        if($element->getIdIncrement() > 0) {
            $element->setSymbolRoute($this->symbolRoute);
            return $this->display($form, $element);
        }else{
            return $this->error();
        }
    }

    public function display(FloorPlan $floorPlan, Element $element)
    {



        return $this->templating->renderResponse(
            'BackendBundle:Element:displayFloorplanElement.html.twig',
            array(
                'element' => ElementFactory::newInstance($floorPlan, $element),
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