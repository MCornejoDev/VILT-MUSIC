<?php

function renderInput($name, $type = 'text', $label = '', $id = '', $class = '')
{
    $id = $id ?: $name; // Usa el nombre como ID si no se especifica uno.
    include 'input_view.php';
}

function renderInputImage($name, $label = '', $id = '', $class = '')
{
    $id = $id ?: $name; // Usa el nombre como ID si no se especifica uno.
    include 'input_image_view.php';
}
