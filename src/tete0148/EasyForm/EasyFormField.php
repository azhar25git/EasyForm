<?php

namespace tete0148\EasyForm;

use tete0148\EasyForm\Validator\Rules\RequiredRule;
use tete0148\EasyForm\Validator\Rules\Rule;

class EasyFormField extends HTMLElement {

    private $name;
    private $type;
    private $options = []; // only if type equals select
    private $rules = [];
    private $label = NULL;

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
     * Add a label to the field
     * You can set the label from an EasyFormLabel instance or from the label's value (but you won't be able to change classes, id, or other html attributes)
     *
     * @param $label EasyFormLabel|string
     * @return $this EasyFormField
     */
    public function setLabel($label)
    {
        if($label instanceof EasyFormLabel)
            $this->label = $label;
        else {
            $this->label= new EasyFormLabel();
            $this->label->setValue($label);
        }

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Make field required
     *
     * @return $this EasyFormField
     */
    public function required()
    {
        $this->attributes['required'] = 'required';
        $this->addRule(new RequiredRule());

        return $this;
    }

    /**
     * Set select field options
     *
     * @param $optionsArray Array of instances of EasyFormSelectOption
     * @throws \Exception If the field is not a select
     * @return $this EasyFormField
     */
    public function setOptions($optionsArray)
    {
        if($this->type != 'select')
            throw new \Exception('Trying to add options to a non-select field');
        foreach ($optionsArray as $option) {
            $this->options[] = $option;
        }

        return $this;
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

    /**
     * Add a rule to the field
     *
     * @param $rule Rule
     * @return $this EasyFormField
     */
    public function addRule($rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * Get field rules
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param $value string Set the field's value
     */
    public function setValue($value)
    {
        $this->attributes['value'] = $value;
    }
}
