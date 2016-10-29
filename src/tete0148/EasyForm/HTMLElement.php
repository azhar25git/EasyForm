<?php

namespace tete0148\EasyForm;


class HTMLElement
{
    protected $attributes = [];

    /**
     * Set attributes array
     *
     * @param $attributes
     * @return $this EasyFormField
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
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
     * @return $this EasyFormField
     */
    public function addAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Set attribute class
     *
     * @param $class
     * @return $this EasyFormField
     */
    public function setClass($class)
    {
        $this->attributes['class'] = $class;

        return $this;
    }

    /**
     * Set field id
     *
     * @param $id
     * @return $this EasyFormField
     */
    public function setId($id)
    {
        $this->attributes['id'] = $id;

        return $this;
    }
}