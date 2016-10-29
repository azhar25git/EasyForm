<?php


namespace tete0148\EasyForm\Validator\Rules;


use tete0148\EasyForm\Validator\Validator;

abstract class Rule
{
    protected $name;

    /**
     * @param $content mixed
     * @return bool
     */
    abstract function validate($content);

    /**
     * Return rule's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}