<?php

namespace tete0148\EasyForm;

class EasyFormField {

    private $name;
    private $type;

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

}