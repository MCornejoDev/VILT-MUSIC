<?php

return [
    'rules' => [
        'required' => 'es obligatorio',
        'email' => 'debe ser un correo electrónico válido',
        'min' => [
            'one' => 'debe tener al menos 1 caracter',
            'other' => 'debe tener al menos :min caracteres',
        ],
        'max' => [
            'one' => 'debe tener como máximo 1 caracter',
            'other' =>  'debe tener como máximo :max caracteres',
        ],
        'unique' => 'debe ser único',
    ]
];
