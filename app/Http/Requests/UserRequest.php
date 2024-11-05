<?php

namespace App\Http\Requests;

require_once __DIR__ . '/BaseRequest.php';

class UserRequest extends BaseRequest
{
    public static function isValid($data): bool
    {
        // Usar array_walk para llenar el array de errores
        array_walk($data, function ($value, $key) use (&$errors) {
            if (empty($value)) { // Si el valor es vacío, nulo o falso
                $errors[$key] = []; // Agregar la clave al array de errores
            }
        });

        $hasErrors = empty($errors);

        if (!$hasErrors) {
            addToBag('errors', $errors);
        }

        return $hasErrors;
    }
}
