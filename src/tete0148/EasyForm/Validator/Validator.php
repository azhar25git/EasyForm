<?php

namespace tete0148\EasyForm\Validator;

use Symfony\Component\Yaml\Yaml;
use tete0148\EasyForm\EasyForm;

class Validator
{
    private $validated = [];

    /**
     * Return an bidimensional error array, with one index for each field
     *
     * @return array
     */
    public function getErrors()
    {
        $errors = [];
        foreach ($this->validated as $field => $rules) {
            foreach ($rules as $rule => $correct) {
                if(!$correct)
                    $errors[$field][$rule] = $this->getTranslation($rule);
            }
        }
        return $errors;
    }

    private function getTranslation($rule)
    {
        $yaml = Yaml::parse(file_get_contents(EasyForm::getResourcesPath() . '/lang/validator_errors.yaml'));
        return $yaml[EasyForm::getLang()][$rule];
    }

    /**
     * @param $fieldName
     * @param $ruleName
     * @param $validated
     */
    public function addValidated($fieldName, $ruleName, $validated)
    {
        $this->validated[$fieldName][$ruleName] = $validated;
    }
}