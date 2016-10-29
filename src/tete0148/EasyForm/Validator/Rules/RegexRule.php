<?php

namespace tete0148\EasyForm\Validator\Rules;


class RegexRule extends  Rule
{
    /**
     * @var string
     */
    private $rexex;

    /**
     * RegexRule constructor.
     * @param $rexex string The regex
     */
    public function __construct($rexex)
    {
        $this->rexex = $rexex;
        $this->name = 'regex';
    }

    /**
     * @param $content mixed
     * @return bool
     */
    public function validate($content)
    {
        return preg_match($this->regex, $content) === 1;
    }
}