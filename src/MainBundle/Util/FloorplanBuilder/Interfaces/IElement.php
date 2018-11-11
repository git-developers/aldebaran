<?php

namespace MainBundle\Util\FloorplanBuilder\Interfaces;
use MainBundle\Entity\FloorPlan;
use MainBundle\Entity\Element;

interface IElement {

    function processLabel(Element $element);
    function processTag(FloorPlan $floorPlan, Element $element);

}