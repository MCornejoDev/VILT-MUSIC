<?php

require_once './models/categoria.php';

class Utils
{

    public static function deleteSession($nombre)
    {
        if (isset($_SESSION[$nombre])) {
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }

        return $nombre;
    }

    public static function showCategories()
    {
        $categorias = new Categoria();
        $categorias = $categorias->getAll();
        return $categorias;
    }

    public static function redirect($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
            exit;
        }
    }
}
