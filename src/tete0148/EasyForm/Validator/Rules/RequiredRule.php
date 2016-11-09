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
        $condition = !is_null($content) && isset($content) && (!empty($content) || strlen(strval($content)) > 0);
        return $condition;
    }
}