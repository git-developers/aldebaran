<?php

namespace MainBundle\Util\ElementBuilder\Model;
use MainBundle\Entity\Form;
use MainBundle\Entity\Element;
use MainBundle\Util\ElementBuilder\ExtendsClass\gridLayout;
use MainBundle\Util\ElementBuilder\Interfaces\IElement;

class TextElement extends gridLayout implements IElement
{

    private $id;
    private $label;
    private $tag;

    /**
     * @param Form $form
     * @param Element $element
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
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
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

        $required = ($element->getTagRequired())? 'required' : '';
        $readonly = ($element->getTagReadonly())? 'readonly' : '';
        $disabled = ($element->getTagDisabled())? 'disabled' : '';

        $out = "<div class='input-group'>";
        $out .= "<span class='input-group-addon' title='{$element->getTagName()}'><i class='fa fa-fw fa-align-left'></i></span>";
        $out .= "<input
                type='text'
                class='form-control'
                name='saveEventForm[{$form->getUniqueId()}][{$element->getTagName()}_{$element->getUniqueId()}]'
                value='{$element->getTagValue()}'
                id='{$element->getTagId()}'
                placeholder='{$element->getTagPlaceholder()}'
                {$required}
                {$readonly}
                {$disabled}
                />";
        $out .= "<input type='hidden' name='form[element][]' value='{$element->getIdIncrement()}'>";
        $out .= "</div>";

        return $out;
    }
}