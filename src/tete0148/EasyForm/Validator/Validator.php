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
        return $this->getTranslation('email');
    }

    private function getTranslation($rule)
    {
        $yaml = Yaml::parse(file_get_contents(EasyForm::getResourcesPath() . '/lang/validator_errors.yaml'));
        return $yaml[EasyForm::getLang()];
    }

    /**
     * @param $ruleName
     * @param $validated
     */
    public function addValidated($ruleName, $validated)
    {
        $this->validated[$ruleName] = $validated;
    }
}