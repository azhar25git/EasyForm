<?php

namespace tete0148\EasyForm\Validator\Rules;


class InListRule extends Rule
{

    private $list;

    /**
     * InListRule constructor.
     * @param $list array
     */
    public function __construct($list)
    {
        $this->name = 'inlist';
        $this->list = $list;
    }

    /**
     * @param $content mixed
     * @return bool
     */
    public function validate($content)
    {
        return in_array($content, $this->list);
    }
}