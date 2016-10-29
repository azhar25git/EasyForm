<?php

namespace tete0148\EasyForm\Validator\Rules;


class LengthRule extends Rule
{
    /**
     * @var int
     */
    private $length;

    /**
     * MaxLengthRule constructor.
     * @param $length int
     */
    public function __construct($length)
    {
        $this->name = 'maxlength';

        $this->length = $length;
    }

    /**
     * @param $content string
     * @return int
     */
    public function validate($content)
    {
        return strlen($content) == $this->length;
    }
}