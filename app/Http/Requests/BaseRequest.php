<?php

namespace App\Http\Requests;

class BaseRequest
{
    /**
     * This method returns the data from the request.
     * @return array 
     */
    public static function getData(): array
    {
        $data = [];

        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        foreach ($_FILES as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}
