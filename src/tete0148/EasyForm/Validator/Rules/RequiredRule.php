<?php

namespace tete0148\EasyForm\Validator\Rules;

class RequiredRule extends Rule
{

    public function __construct()
    {
        $this->name = 'required';
    }

    /**
     * @param $content mixed
     * @return int
     */
    public function validate($content)
    {
        return !is_null($content) && isset($content) && !empty($content);
    }
}