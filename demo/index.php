<?php use tete0148\EasyForm\EasyForm;
use tete0148\EasyForm\EasyFormLabel;
use tete0148\EasyForm\EasyFormSelectOption;
use tete0148\EasyForm\Validator\Rules\AlphanumericRule;
use tete0148\EasyForm\Validator\Rules\AlphaRule;
use tete0148\EasyForm\Validator\Rules\EmailRule;
require_once '../vendor/autoload.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>EasyForm demo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>EasyForm</h1>
    <?php
        $easyform = new EasyForm('demo');
        $label = new EasyFormLabel();
        $label->setValue('Your last name:');
        $easyform->addField('lname', 'text')
                        ->required()
                        ->addAttribute('autocomplete', 'off')
                        ->setLabel($label);

        $label = new EasyFormLabel();
        $label->setValue('Your first name:');
        $easyform->addField('fname', 'text')
                        ->required()
                        ->addAttribute('autocomplete', 'off')
                        ->setLabel($label);

        $label = new EasyFormLabel();
        $label->setValue('Your city:');
        $field = $easyform->addField('city', 'select')
                                ->setLabel($label);
        $cities_array = array (
          0 =>
          array (
            'city' => 'Sant Julià de Lòria',
            'region' => '06',
            'country' => 'AD',
            'latitude' => '42.46372',
            'longitude' => '1.49129',
          ),
          1 =>
          array (
            'city' => 'Pas de la Casa',
            'region' => '03',
            'country' => 'AD',
            'latitude' => '42.54277',
            'longitude' => '1.73361',
          ),
          2 =>
          array (
            'city' => 'Ordino',
            'region' => '05',
            'country' => 'AD',
            'latitude' => '42.55623',
            'longitude' => '1.53319',
          ),
          3 =>
          array (
            'city' => 'les Escaldes',
            'region' => '08',
            'country' => 'AD',
            'latitude' => '42.50729',
            'longitude' => '1.53414',
          ),
          4 =>
          array (
            'city' => 'la Massana',
            'region' => '04',
            'country' => 'AD',
            'latitude' => '42.54499',
            'longitude' => '1.51483',
          ),
          5 =>
          array (
            'city' => 'Encamp',
            'region' => '03',
            'country' => 'AD',
            'latitude' => '42.53451',
            'longitude' => '1.5767',
          ),
          6 =>
          array (
            'city' => 'Canillo',
            'region' => '02',
            'country' => 'AD',
            'latitude' => '42.5669',
            'longitude' => '1.59556',
          ),
          7 =>
          array (
            'city' => 'Arinsal',
            'region' => '04',
            'country' => 'AD',
            'latitude' => '42.57205',
            'longitude' => '1.48453',
          ),
          8 =>
          array (
            'city' => 'Andorra la Vella',
            'region' => '07',
            'country' => 'AD',
            'latitude' => '42.50779',
            'longitude' => '1.52109',
          ),
          9 =>
          array (
            'city' => 'Umm al Qaywayn',
            'region' => '07',
            'country' => 'AE',
            'latitude' => '25.5864',
            'longitude' => '55.57603',
          ),
          10 =>
          array (
            'city' => 'Ra’s al Khaymah',
            'region' => '05',
            'country' => 'AE',
            'latitude' => '25.78953',
            'longitude' => '55.9432',
          ),);
        $options = [];

        //filling select's options
        foreach($cities_array as $index => $city) {
            $options[] = new EasyFormSelectOption($index, $city['city']);
        }
        $field->setOptions($options);

        $label = new EasyFormLabel();
        $label->setValue('Your message:');
        $easyform->addField('comment', 'textarea')
                        ->setLabel($label)
                        ->required();
        $easyform->addField('submit', 'submit')->setAttributes(['value' => 'Submit']);

        $valid = false;
        //validating form
        if(isset($_POST['demo']))
            $valid = $easyform->validate($_POST);

        if($valid)
            die('Form is ok');

        //display form (it will display with errors once validated)
        echo $easyform->render();
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>