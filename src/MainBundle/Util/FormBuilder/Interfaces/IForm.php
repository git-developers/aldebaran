<?php

namespace MainBundle\Util\FormBuilder\Interfaces;
use MainBundle\Entity\Element;

interface IForm {

    function Label(Element $element);
    function Tag(Element $element);

}