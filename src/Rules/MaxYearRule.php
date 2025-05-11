<?php

namespace CustomValidation\Rules;

use CustomValidation\Validator;
use DateTime;
use Exception;

class MaxYearRule
{
    public function validate(Validator $validator, string $field, $value, int $maxYear): bool
    {
        try {
            $date = new DateTime($value);
            if ((int)$date->format('Y') > $maxYear) {
                $validator->addError($field, "Year must be before {$maxYear}");
                return false;
            }
        } catch (Exception $e) {
            $validator->addError($field, "Invalid date format");
            return false;
        }

        return true;
    }
}