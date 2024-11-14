<?php

namespace App;

use PDO;
use PDOException;

/**
 * Class Database
 * @package App
 */
class Database
{
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=" . $_ENV['MYSQL_HOST'] . ";dbname=" . $_ENV['MYSQL_DATABASE'] . ";charset=UTF8";

        try {
            // Crea la conexión y guárdala en una propiedad privada
            $this->pdo = new PDO($dsn, 'root', $_ENV['MYSQL_PASSWORD']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión a la base de datos: " . $e->getMessage();
            exit; // Termina la ejecución si ocurre un error de conexión
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
