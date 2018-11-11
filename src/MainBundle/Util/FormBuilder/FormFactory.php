<?php

namespace MainBundle\Util\FormBuilder;
use MainBundle\Entity\Form;

class FormFactory {

    public static $unique;

    public function __construct() {
        $this->unique = uniqid();
    }


}