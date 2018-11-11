<?php

namespace MainBundle\Util\ElementBuilder\Interfaces;
use MainBundle\Entity\Form;
use MainBundle\Entity\Element;

interface IElement {

    function processLabel(Element $element);
    function processTag(Form $form, Element $element);

}