<?php

namespace tete0148\EasyForm;


class EasyFormLabel extends HTMLElement
{

    public function setValue($value)
    {
        $this->attributes['value'] = $value;
    }

}