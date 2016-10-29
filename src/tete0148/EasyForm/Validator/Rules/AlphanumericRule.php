<?php

namespace tete0148\EasyForm\Validator\Rules;


class AlphanumericRule extends Rule
{

    public function __construct()
    {
        $this->name = 'alphanumeric';
    }

    /**
     * @param $content mixed
     * @return bool
     */
    public function validate($content)
    {
        $regex = '#(^a-zA-Z0-9)*#';
        return preg_match($regex, $content) !== 1 AND preg_match($regex, $content) === 0;
    }
}