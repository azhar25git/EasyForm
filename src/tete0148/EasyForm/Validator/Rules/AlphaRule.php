<?php

namespace tete0148\EasyForm\Validator\Rules;


class AlphaRule extends Rule
{

    public function __construct()
    {
        $this->name = 'alpha';
    }

    /**
     * @param $content mixed
     * @return bool
     */
    function validate($content)
    {
        $regex = '#[^a-zA-Z]*#';
        return preg_match($regex , $content) !== 1 AND preg_match($regex, $content) === 0;
    }
}