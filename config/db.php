<?php

/**Creamos una clase estática que contendra la conexión a la base de datos */
class Database
{
    public static function connect()
    {
        $db = new mysqli($_ENV['MYSQL_HOST'], 'root', $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
        if ($db->connect_error) {
            die("No se pudo conectar a la base de datos: " . $db->connect_error);
        }
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
