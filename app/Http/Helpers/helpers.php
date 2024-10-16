<?php

if (! function_exists('__')) {
    function __(string $key)
    {
        setKey(getLanguage(), $key);
    }
}

if (! function_exists('setKey')) {
    function setKey(string $lang, string $key)
    {
        $value = getKey($lang, $key);

        // Imprime el valor obtenido
        print($value);
    }
}

if (! function_exists('getKey')) {
    function getKey(string $lang, string $key)
    {
        $splits = explode('.', $key);
        $file = array_shift($splits);

        $path = __DIR__ . '/../../../lang/' . $lang . '/' . $file . '.php';

        if (file_exists($path)) {
            // Incluimos el archivo y obtenemos el array
            $keys = include $path;
        }

        // Utiliza array_reduce para obtener el valor final del array multidimensional
        // Utilizamos array_reduce para navegar por el array anidado
        return array_reduce($splits, function ($carry, $item) {
            return isset($carry[$item]) ? $carry[$item] : null;
        }, $keys);
    }
}

if (! function_exists('getLanguage')) {
    function getLanguage()
    {
        $lang = "es";
        if (empty($_GET['lang'])) {
            $lang = 'es';
        } else {
            $lang = htmlspecialchars($_GET['lang']);
        }
        return $lang;
    }
}
