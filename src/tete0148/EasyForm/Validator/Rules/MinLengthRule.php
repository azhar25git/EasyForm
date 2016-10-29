<?php

namespace tete0148\EasyForm\Validator\Rules;

class MinLengthRule extends Rule
{
    /**
     * @var int
     */
    private $minLength;

    /**
     * MaxLengthRule constructor.
     * @param $minLength int
     */
    public function __construct($minLength)
    {
        $this->name = 'maxlength';

        $this->minLength = $minLength;
    }

    /**
     * @param $content string
     * @return int
     */
    public function validate($content)
    {
        return strlen($content) >= $this->minLength;
    }
}