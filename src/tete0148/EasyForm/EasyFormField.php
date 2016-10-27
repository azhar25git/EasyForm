<?php

namespace tete0148\EasyForm;

class EasyFormField {

    private $name;
    private $type;
    private $attributes = [];
    private $options = []; // only if type equals select

    /**
     * EasyFormField constructor.
     * @param $name
     * @param $type
     * @throws \Exception
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        if(in_array($type, EasyFormFieldTypes::getTypes()))
            $this->type = $type;
        else
            throw new \Exception('Unknown field type "' . $type . '"');
    }

    /**
     * Set attributes array
     *
     * @param $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array Attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add an attribute
     *
     * @param $attribute
     * @param $value
     */
    public function addAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * Set attribute class
     *
     * @param $class
     */
    public function setClass($class)
    {
        $this->attributes['class'] = $class;
    }

    /**
     * Set field id
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    /**
     * Make field required
     *
     */
    public function required()
    {
        $this->attributes['required'] = 'required';
    }

    /**
     * Set select field options
     *
     * @param $optionsArray Array of instances of EasyFormSelectOption
     * @throws \Exception If the field is not a select
     */
    public function setOptions($optionsArray)
    {
        if($this->type != 'select')
            throw new \Exception('Trying to add options to a non-select field');
        foreach ($optionsArray as $option) {
            $this->options[] = $option;
        }

        return;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getOptions()
    {
        if($this->type != 'select')
            throw new \Exception('Trying to add options to a non-select field');

        return $this->options;
    }

    /**
     * Get field's name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}