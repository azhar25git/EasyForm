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
        if($content === 0 || $content === '0')
            return true;
        return !is_null($content) && isset($content) && !empty($content);
    }
}