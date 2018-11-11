<?php

namespace MainBundle\Util\ElementBuilder;
use MainBundle\Entity\Form;
use MainBundle\Entity\Element;

class ElementFactory {

    public static $unique;

    public function __construct(Element $element) {
        $this->unique = uniqid();
    }

    public static function newInstance (Form $form, Element $element) {
        $elementType = "MainBundle\\Util\\ElementBuilder\\Model\\".$element->getElementType()->getType();

        if (class_exists($elementType)) {
            return new $elementType($form, $element);
        }
    }

}