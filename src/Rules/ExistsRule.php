<?php

namespace CustomValidation\Rules;

use CustomValidation\Validator;
use Illuminate\Database\Eloquent\Model;

class ExistsRule
{
    public function validate(Validator $validator, string $field, $value, string $modelClass): bool
    {
        if (!class_exists($modelClass) || !is_subclass_of($modelClass, Model::class)) {
            $validator->addError($field, "Invalid model class");
            return false;
        }

        if (!$modelClass::where('id', $value)->exists()) {
            $validator->addError($field, "Record does not exist");
            return false;
        }

        return true;
    }
}