<?php

namespace tete0148\EasyForm;

use tete0148\EasyForm\Validator\Validator;

class EasyForm {

    private static $LANG = 'en';
    private static $resourcesPath = __DIR__ . '/../../resources';

    private $name;
    private $method;
    private $url;
    /**
     * @var EasyFormField[]
     */
    private $fields = [];
    private $allowFiles = false;
    private $validated = null;
    /**
     * @var Validator
     */
    private $validator = NULL;
    //private $resourcesPathCustom = NULL;

    /**
     * EasyForm constructor.
     * @param $name string Name of the form
     * @param $url string $url
     * @param $method string $method
     */
    public function __construct($name, $url = '', $method = 'POST')
    {
        $this->name = $name;
        $this->method = $method;
        $this->url = $url;
    }

    /**
     * Add a field to the form
     *
     * @param $name string Name of the field
     * @param string $type
     * @return EasyFormField The field
     */
    public function addField($name, $type = 'text')
    {
        $field = new EasyFormField($name, $type);
        $this->fields[$name] = $field;

        return $field;
    }

    /**
     * Validate form contents
     *
     * @param $data array
     * @return bool
     * @throws \Exception
     */
    public function validate($data)
    {
        if(!isset($data[$this->getName()]))
            throw new \Exception('Invalid data (maybe $_POST is empty ?)');
        $this->validator = new Validator();
        $validated = true;

        foreach ($this->fields as $field) {
            $rules = $field->getRules();
            foreach ($rules as $rule) {
                if($validated)
                    $validated = $rule->validate($data[$this->name][$field->getName()]);
                $this->validator->addValidated($field->getName(), $rule->getName(), $validated);
            }
        }
        $this->validated = $validated;

        return $this->validated;
    }

    /**
     * Render form
     *
     * @return string
     */
    public function render()
    {
        $formTemplate = file_get_contents(self::$resourcesPath . '/templates/form.html.twig');
        $formTemplate = str_replace('{{ method }}', 'method="'.$this->method .'"', $formTemplate);
        $formTemplate = str_replace('{{ action }}', 'action="'.$this->url .'"', $formTemplate);

        if($this->validated !== null) {
            $errorsTemplate = file_get_contents(self::$resourcesPath . '/templates/errors.html.twig');
            $errors = '<ul>';
            foreach ($this->validator->getErrors() as $field) {
                foreach ($field as $error) {
                    $errors .= '<li>' . $error . '</li>';
                }
            }
            $errors .= '</ul>';
            $errorsTemplate = str_replace('{{ errors }}', $errors, $errorsTemplate);
            $formTemplate = str_replace('{{ errors }}', $errorsTemplate, $formTemplate);
        } else {
            $formTemplate = str_replace('{{ errors }}', '', $formTemplate);
        }


        $formTemplate = str_replace('{{ enctype }}', ($this->allowFiles) ? 'enctype="multipart/form-data"' : '', $formTemplate);
        $fieldsTemplate = '';
        $fields = $this->fields;

        foreach ($fields as $field) {
            $fieldsTemplate .= $this->renderField($field);
        }
        $formTemplate = str_replace('{{ fields }}', $fieldsTemplate, $formTemplate);


        return $formTemplate;
    }

    /**
     * Render a field as html
     *
     * @param $element HTMLElement The field to render
     * @return string The field as HTML
     */
    public function renderField($element)
    {
        $type = '';
        if($element instanceof EasyFormField)
            $type = $element->getType();

        $attributes = $element->getAttributes();
        $template = null;
        if($type == 'textarea') {
            $template = file_get_contents(self::$resourcesPath . '/templates/textarea.html.twig');
            //custom replacements
        }
        else if($type == 'select') {
            $template = file_get_contents(self::$resourcesPath . '/templates/select.html.twig');
            //custom replacements
            $options_str = '';
            $options = $element->getOptions();

            foreach($options as $option) {
                $options_str .= '<option value="'.$option->getValue().'"'. (($option->isSelected())? 'selected>' : '>') . $option->getPlaceholder() . '</option>';
            }
            $template = str_replace('{{ options }}', $options_str, $template);
        }
        else if($type == 'submit') {
            $template = file_get_contents(self::$resourcesPath . '/templates/submit.html.twig');
        }
        else if($element instanceof EasyFormLabel) {
            $template = file_get_contents(EasyForm::getResourcesPath() . '/templates/label.html.twig');
        }
        else {
            $template = file_get_contents(self::$resourcesPath . '/templates/input.html.twig');
            $template = str_replace('{{ type }}', 'type="' . $type . '"', $template);
        }
        //global replacements

        //id
        $template = str_replace('{{ id }}', (isset($attributes['id']) ? 'id="' . $attributes['id'] . '"' : ''), $template);
        unset($attributes['id']);

        //class
        $template = str_replace('{{ classes }}', (isset($attributes['class']) ? $attributes['class'] : ''), $template);
        unset($attributes['class']);

        //required
        $template = str_replace('{{ required }}', (isset($attributes['required']) ? 'required="required"' : ''), $template);
        unset($attributes['required']);

        //value
        $template = str_replace('{{ value }}', (isset($attributes['value']) ? $attributes['value'] : ''), $template);
        unset($attributes['value']);

        //errors
        if($element instanceof EasyFormField && $this->validated !== null && isset($this->getErrors()[$element->getName()])) {
            $errorsTemplate = file_get_contents(self::$resourcesPath . '/templates/errors.html.twig');
            $errors = '<ul>';
            foreach ($this->getErrors()[$element->getName()] as $error) {
                $errors .= '<li>' . $error . '</li>';
            }
            $errors .= '</ul>';
            $errorsTemplate = str_replace('{{ errors }}', $errors, $errorsTemplate);
            $template = str_replace('{{ errors }}', $errorsTemplate, $template);
        }

        if($element instanceof EasyFormField && $element->getLabel() != NULL) {
            $label = $element->getLabel();
            $labelTemplate = $this->renderField($label);
            $template = str_replace('{{ label }}', $labelTemplate, $template);
        } else {
            $template = str_replace('{{ label }}', '', $template);
        }


        if($element instanceof EasyFormField)
            $template = str_replace('{{ name }}', 'name="'.$this->name . '[' . $element->getName() . ']"', $template);

        //other attributes
        $attributesTemplate = '';
        foreach ($attributes as $k => $attribute) {
            $attributesTemplate .= $k . '="' . $attribute .'" ';
        }
        $template = str_replace('{{ attributes }}', $attributesTemplate, $template);

        $template = preg_replace('/{{ [A-Za-z0-9_]+ }}/', '', $template);


        return $template;
    }

    /**
     * @return string
     */
    public static function getLang()
    {
        return self::$LANG;
    }

    /**
     * @param $lang
     */
    public static function setLang($lang)
    {
        self::$LANG = $lang;
    }

    /**
     * @return string
     */
    public static function getResourcesPath()
    {
        return self::$resourcesPath;
    }

    /**
     * @param string $resourcesPath
     */
    public static function setResourcesPath($resourcesPath)
    {
        self::$resourcesPath = $resourcesPath;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return validator errors text
     *
     */
    public function getErrors()
    {
        if($this->validator === NULL) {
            throw new \Exception('You must validate the form before trying to get errors');
        }
        return $this->validator->getErrors();
    }

    /**
     * @param $field string The field name
     * @param $error string The error message
     * @return $this EasyForm
     */
    public function addError($field, $error)
    {
        $this->validator->addError($field, $error);

        return $this;
    }

}