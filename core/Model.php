<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public array $errors;

    public function loadData($postData)
    {
        foreach ($postData AS $name => $value){
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
    }

    abstract function rules(): array;

    public function validate(): bool
    {
        foreach ($this->rules() AS $attribute => $rules){
            $value = $this->{$attribute};
            foreach ($rules AS $rule){
                $ruleName = $rule;

                if (!is_string($rule)){
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL)){
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule["min"]){
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule["max"]){
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule["match"]}){
                    $this->addError($attribute, self::RULE_MATCH,$rule);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, array $params = [])
    {
        $errorMessage = $this->errorMessage()[$rule] ?? '';
        foreach ($params AS $key => $value){
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }

    public function errorMessage(): array
    {
        return [
            self::RULE_REQUIRED => 'this field required',
            self::RULE_EMAIL => 'this email dose not valid',
            self::RULE_MIN => 'this field min characters {min}',
            self::RULE_MAX => 'this field max characters {max}',
            self::RULE_MATCH => 'this field dose not match with {match}'
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

}