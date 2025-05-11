<?php

namespace CustomValidation;

class Validator
{
    protected $errors = [];

    protected $rules = [];

    public function validate(array $data): bool
    {
        foreach ($this->rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $value = $data[$field] ?? null;
                $this->applyRule($field, $rule, $value);
            }
        }
        return empty($this->errors);
    }

    protected function applyRule(string $field, string $rule, $value): void
    {
        if (strpos($rule, ':') !== false) {
            $parts = explode(':', $rule, 2);
            $ruleName = $parts[0];
            $parameter = $parts[1];
            $this->applyParameterizedRule($field, $ruleName, $value, $parameter);
        } else {
            $this->applyBasicRule($field, $rule, $value);
        }
    }

    protected function applyBasicRule(string $field, string $rule, $value): void
    {
        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, $rule);
                }
                break;
        }
    }

    protected function applyParameterizedRule(string $field, string $rule, $value, string $parameter): void
    {
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(string $field, string $message): void
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
    }
}