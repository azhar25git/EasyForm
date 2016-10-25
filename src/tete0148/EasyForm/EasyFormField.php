<?php

namespace tete0148\EasyForm;

class EasyFormField {

    private $name;
    private $type;
    private $attributes = [];

    /**
     * EasyFormField constructor.
     * @param $name
     * @param $type
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
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
}