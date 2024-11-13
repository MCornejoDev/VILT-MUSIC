<?php

return [
    'rules' => [
        'required' => 'is required',
        'email' => 'must be a valid email',
        'min' => [
            'one' => 'must be at least 1 character',
            'other' => 'must be at least :min characters',
        ],
        'max' => [
            'one' => 'must be at most 1 character',
            'other' => 'must be at most :max characters',
        ],
        'unique' => 'must be unique',
    ]
];
