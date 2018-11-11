<?php

namespace MainBundle\Util\FloorplanBuilder\ExtendsClass;

class gridLayout
{

    protected $numberOfColumns;
    protected $boxBodyStyle;
    protected $boxHeaderClass;
    protected $boxHeaderStyle;

    /**
     * @param Form $form
     * @param Element $element
     */
    public function __construct($numberOfColumns = 6, $boxBodyStyle = '', $boxHeaderClass = '', $boxHeaderStyle = '')
    {
        $this->numberOfColumns = $numberOfColumns;
        $this->boxBodyStyle = $boxBodyStyle;
        $this->boxHeaderClass = $boxHeaderClass;
        $this->boxHeaderStyle = $boxHeaderStyle;
    }

    /**
     * @return int
     */
    public function getNumberOfColumns()
    {
        return $this->numberOfColumns;
    }

    /**
     * @param int $numberOfColumns
     */
    public function setNumberOfColumns($numberOfColumns)
    {
        $this->numberOfColumns = $numberOfColumns;
    }

    /**
     * @return string
     */
    public function getBoxBodyStyle()
    {
        return $this->boxBodyStyle;
    }

    /**
     * @param string $boxBodyStyle
     */
    public function setBoxBodyStyle($boxBodyStyle)
    {
        $this->boxBodyStyle = $boxBodyStyle;
    }

    /**
     * @return string
     */
    public function getBoxHeaderClass()
    {
        return $this->boxHeaderClass;
    }

    /**
     * @param string $boxHeaderClass
     */
    public function setBoxHeaderClass($boxHeaderClass)
    {
        $this->boxHeaderClass = $boxHeaderClass;
    }

    /**
     * @return string
     */
    public function getBoxHeaderStyle()
    {
        return $this->boxHeaderStyle;
    }

    /**
     * @param string $boxHeaderStyle
     */
    public function setBoxHeaderStyle($boxHeaderStyle)
    {
        $this->boxHeaderStyle = $boxHeaderStyle;
    }





}