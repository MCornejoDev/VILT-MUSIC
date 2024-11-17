<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use ReflectionClass;

class UserRequest extends BaseRequest
{
    private array $rules;

    public function __construct(array $rules)
    {
        parent::__construct(__CLASS__);
        $this->rules = $rules;
    }

    public function isValid($data): bool
    {
        $errors = [];

        foreach ($this->rules as $key => $value) {
            if (array_key_exists($key, $data)) {
                $allRules = $this->splitRules($value);

                foreach ($allRules as $rule) {
                    $error = $this->applyRule($rule, $data[$key], $key);

                    if (!is_null($error)) {
                        $errors[$key][] = $error;
                    }
                }
            }
        }

        return $this->handleErrors($errors);
    }
}
