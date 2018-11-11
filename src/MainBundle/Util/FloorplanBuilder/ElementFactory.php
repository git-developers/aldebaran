<?php

namespace MainBundle\Util\FloorplanBuilder;
use MainBundle\Entity\FloorPlan;
use MainBundle\Entity\Element;

class ElementFactory {

    public static $unique;

    public function __construct(Element $element) {
        $this->unique = uniqid();
    }

    public static function newInstance (FloorPlan $floorPlan, Element $element) {
        $elementType = "MainBundle\\Util\\FloorplanBuilder\\Model\\".$element->getElementType()->getType();

        if (class_exists($elementType)) {

            return new $elementType($floorPlan, $element);
        }
    }

}