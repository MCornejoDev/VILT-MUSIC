<?php

namespace App\Http\Requests;

require_once __DIR__ . '/BaseRequest.php';

class UserRequest extends BaseRequest
{
    public static function isValid($data, $rules): bool
    {
        foreach ($rules as $key => $value) {

            if (array_key_exists($key, $data)) {
                $errors[$key] = [];
                $allRules = self::splitRules($value);
                foreach ($allRules as $rule) {

                    $error = match ($rule[0]) {
                        'required' => self::isRequired($data[$key], $key),
                        'email' => self::isEmail($data[$key], $key),
                        'unique' => self::isUnique($rule[1], $key, $data[$key]),
                        'min' => self::minLength($data[$key], $rule[1], $key),
                        'max' => self::maxLength($data[$key], $rule[1], $key),
                    };
                    array_push($errors[$key], $error);
                }
            }
        }

        $hasErrors = empty($errors);

        if (!$hasErrors) {
            addToBag('errors', $errors);
        }

        return $hasErrors;
    }

    public static function getError() {}
}
