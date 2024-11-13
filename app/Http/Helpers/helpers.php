<?php

use App\Models\Category;

if (! function_exists('__')) {
    /**
     * This method prints the key from the language file
     * @param string $key 
     * @return void 
     */
    function __(string $key): void
    {
        print(getKey($key));
    }
}

if (! function_exists('getKey')) {
    /**
     * This method gets the key from the language file
     * @param string $key 
     * @return string 
     */
    function getKey(string $key): string
    {
        $splits = explode('.', $key);
        $file = array_shift($splits);

        $path = __DIR__ . '/../../../lang/' . getLanguage() . '/' . $file . '.php';

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
    /**
     * This method returns a language
     * @return string 
     */
    function getLanguage(): string
    {
        return htmlspecialchars(empty($_GET['lang']) ? 'es' : $_GET['lang']);
    }
}

if (! function_exists('initSession')) {
    /**
     * This method inits the session
     * @return void 
     */
    function initSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            $_SESSION['errors'] = [];
            $_SESSION['messages'] = [];
        }
    }
}

if (! function_exists('addToBag')) {
    /**
     * This method adds a data in a bag of session
     * @param string $key 
     * @param array $data 
     * @return void 
     */
    function addToBag(string $key, array $data): void
    {
        $_SESSION[$key] = $data;
    }
}

if (! function_exists('existsKeyInBag')) {
    /**
     * This method checks if a key exists in a bag of session
     * @param string $key 
     * @param string $bag 
     * @return bool 
     */
    function existsKeyInBag(string $key, string $bag): bool
    {
        return array_key_exists($key, $_SESSION[$bag]);
    }
}

if (! function_exists('hasValuesInBag')) {
    /**
     * This method checks if a bag has values
     * @param string $bag 
     * @return bool 
     */
    function hasValuesInBag(string $bag): bool
    {
        return !empty($_SESSION[$bag]);
    }
}

if (! function_exists('getCategories')) {
    /**
     * This method get all categories
     * @return mysqli_result|bool 
     */
    function getCategories(): mysqli_result|bool
    {
        return (new Category())->getAll();
    }
}

if (!function_exists('redirectTo')) {
    /**
     * This method redirects to a url
     * @param string $url 
     * @return void 
     */
    function redirectTo(string $url): void
    {
        print
            '<script>
                window.setTimeout(function() {
                    window.location = "' . $url . '";
                }, 1);
            </script>';
    }
}

if (!function_exists('identityIsEmpty')) {
    /**
     * This method check if the identity is not empty
     * @return bool 
     */
    function identityIsEmpty(): bool
    {
        return empty($_SESSION['identity']);
    }
}

if (!function_exists('isAdmin')) {
    /**
     * This method checks if the role's identity is a admin
     * @return bool 
     */
    function isAdmin(): bool
    {
        return isset($_SESSION['identity']['role']) && $_SESSION['identity']['role'];
    }
}

if (!function_exists('makeDirectory')) {
    /**
     * This method creates a folder if the directory doesn't exist
     * @param string $folder 
     * @return bool 
     */
    function makeDirectory(string $folder): bool
    {
        return is_dir($folder) || mkdir($folder, 0755, true);
    }
}

if (!function_exists('getData')) {
    /**
     * This method returns the data from the request.
     * @return array 
     */
    function getData(): array
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
