<?php

namespace App\Validators;

use Valitron\Validator as ValitronValidator;

ValitronValidator::lang('fr');

class Validator extends ValitronValidator
{
    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message);
    }
}
