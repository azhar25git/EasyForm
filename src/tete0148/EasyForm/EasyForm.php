<?php

namespace tete0148\EasyForm;

class EasyForm {

    private $name;
    private $fields = [];

    /**
     * EasyForm constructor.
     * @param $name Name of the form
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Add a field to the form
     *
     * @param $name Name of the field
     * @param string $type
     * @return EasyFormField The field
     */
    public function addField($name, $type = 'text')
    {
        $field = new EasyFormField($name, $type);
        $this->fields[$name] = $field;

        return $field;
    }
}