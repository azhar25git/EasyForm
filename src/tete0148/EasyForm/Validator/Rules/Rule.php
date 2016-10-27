<?php


namespace tete0148\EasyForm\Validator\Rules;


use tete0148\EasyForm\Validator\Validator;

abstract class Rule
{
    /**
     * @var Validator
     */
    private $validator;
    protected $name;

    /**
     * RuleInterface constructor.
     * @param $validator Validator
     */
    public function __construct($validator)
    {
        $this->validator = $validator;
    }

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