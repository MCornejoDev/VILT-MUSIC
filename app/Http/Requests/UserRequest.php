<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    public static function isValid($data, $rules): bool
    {
        $errors = [];

        foreach ($rules as $key => $value) {
            if (array_key_exists($key, $data)) {
                $allRules = self::splitRules($value);

                foreach ($allRules as $rule) {
                    $error = self::applyRule($rule, $data[$key], $key);

                    if ($error !== "") {
                        $errors[$key][] = $error;
                    }
                }
            }
        }

        return self::handleErrors($errors);
    }

    public static function getError() {}
}
