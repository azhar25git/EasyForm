<?php

namespace tete0148\EasyForm\Validator\Rules;


class MaxLengthRule extends Rule
{
    /**
     * @var int
     */
    private $maxlength;

    /**
     * MaxLengthRule constructor.
     * @param $maxlength int
     */
    public function __construct($maxlength)
    {
        $this->name = 'maxlength';

        $this->maxlength = $maxlength;
    }

    /**
     * @param $content string
     * @return int
     */
    public function validate($content)
    {
        return strlen($content) <= $this->maxlength;
    }
}