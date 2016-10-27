<?php

namespace tete0148\EasyForm\Validator\Rules;

class EmailRule extends Rule
{

    public function __construct()
    {
        $this->name = 'email';
    }

    /**
     * @param $content mixed
     * @return int
     */
    public function validate($content)
    {
        return filter_var($content, FILTER_VALIDATE_EMAIL);
    }
}