<?php

namespace tete0148\EasyForm;

class EasyFormFieldTypes {

    private static $types = [
        'button',
        'checkbox',
        'color',
        'date',
        'datetime',
        'datetime-local',
        'email',
        'file',
        'hidden',
        'image',
        'month',
        'number',
        'password',
        'radio',
        'range',
        'reset',
        'search',
        'submit',
        'tel',
        'text',
        'time',
        'url',
        'week',
        'textarea',
        'select'
    ];

    public static function getTypes()
    {
        return self::types;
    }
}