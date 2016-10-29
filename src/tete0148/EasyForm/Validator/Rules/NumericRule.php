<?php

namespace tete0148\EasyForm\Validator\Rules;


class NumericRule extends Rule
{

    public function __construct()
    {
        $this->name = 'numeric';
    }

    /**
     * @param $content mixed
     * @return bool
     */
    public function validate($content)
    {
        $regex = '#[^0-9]*#';
        return preg_match($regex , $content) !== 1 AND preg_match($regex, $content) === 0;
    }
}