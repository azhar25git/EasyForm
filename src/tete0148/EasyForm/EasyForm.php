<?php

namespace tete0148\EasyForm;

class EasyForm {

    private $name;
    private $fields = [];
    private $resourcesPath = '../../resources';

    /**
     * EasyForm constructor.
     * @param $name Name of the form
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Add a field to the form
     *
     * @param $name Name of the field
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
     * Render a field as html
     *
     * @param $field string The field to render
     * @return string The field as HTML
     */
    public function renderField($field)
    {
        $html = '';
        $type = $field->getType();
        $attributes = $field->getAttributes();
        if($type == 'textarea') {
            $template = file_get_contents($this->resourcesPath . '/templates/textarea.html.twig');
            //custom replacements
        } else if($type == 'select') {
            $template = file_get_contents($this->resourcesPath . '/templates/select.html.twig');
            //custom replacements
            $options_str = '';
            $options = $field->getOptions();
            foreach($options as $option) {
                $options_str = $options_str . '<option value="'.$option->getValue().'"'. ($option->isSelected())? 'selected>' : '' . $option->getPlaceholder() . '</option>';
            }
            $template = str_replace('{{ options }}', $options_str, $template);
        } else {
            $template = file_get_contents($this->resourcesPath . '/templates/input.html.twig');
        }
        //default replacements
        $template = str_replace('{{ class }}', 'class="'. $attributes['class'] .'"', $template);
            unset($attributes['class']);
        return $html;
    }
}