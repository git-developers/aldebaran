<?php

namespace MainBundle\Util\ElementBuilder\Model;
use MainBundle\Entity\Form;
use MainBundle\Entity\Element;
use MainBundle\Util\ElementBuilder\ExtendsClass\gridLayout;
use MainBundle\Util\ElementBuilder\Interfaces\IElement;

class NumberElement extends gridLayout implements IElement
{

    var $id;
    var $label;
    var $tag;

    /**
     * constructor.
     * @param $label
     * @param $tag
     */
    public function __construct(Form $form, Element $element)
    {
        parent::__construct();
        $this->id = $element->getIdIncrement();
        $this->label = $this->processLabel($element);
        $this->tag = $this->processTag($form, $element);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * metodos que procesan info
     */
    function processLabel(Element $element)
    {
        return "<label for='{$element->getLabelFor()}' style='cursor: move'>{$element->getLabelName()}</label>";
    }

    function processTag(Form $form, Element $element)
    {

        $out = "<div class='input-group'>";
        $out .= "<span class='input-group-addon' title='{$element->getTagName()}'><i class='fa fa-fw fa-sort-numeric-asc'></i></span>";
        $out .= "<input
                type='number'
                class='form-control'
                name='saveEventForm[{$form->getUniqueId()}][{$element->getTagName()}_{$element->getUniqueId()}]'
                value='{$element->getTagValue()}'
                id='{$element->getTagId()}'
                max='{$element->getTagMax()}'
                min='{$element->getTagMin()}'
                placeholder='{$element->getTagPlaceholder()}'
                />";
        $out .= "<input type='hidden' name='form[element][]' value='{$element->getIdIncrement()}'>";
        $out .= "</div>";

        return $out;

    }
}

