<?php

namespace tete0148\EasyForm;

class EasyFormSelectOption {

    private $value;
    private $placeholder;
    private $selected = false;

    /**
     * EasyFormSelectOption constructor.
     * @param $value
     * @param $placeholder
     * @param $selected boolean Is the option selected by default ?
     */
    public function __construct($value, $placeholder, $selected = false)
    {
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->selected = $selected;

    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param mixed $placeholder
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    /**
     * @return mixed
     */
    public function isSelected()
    {
        return $this->selected;
    }

    /**
     *
     */
    public function selected()
    {
        $this->selected = true;
    }

}