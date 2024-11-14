<?php

namespace App\Http\Services;

use App\Models\User;
use PDO;

/**
 * Class UserService
 * @package App\Http\Services
 */
class UserService
{
    public function __construct() {}

    /**
     * This method returns the user information.
     * @param string $email 
     * @return array 
     */
    public static function getUser(string $email): array
    {

        try {
            $user = new User();
            $stmt = $user->db->prepare('SELECT id, username, role, image, address FROM users WHERE email = :email');

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . implode(" ", $user->db->errorInfo()));
            }

            // Vincula el parámetro `:email` en la consulta
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Ejecuta la consulta y verifica si fue exitosa
            if (!$stmt->execute()) {
                throw new \Exception("Error executing statement: " . implode(" ", $stmt->errorInfo()));
            }

            // Obtiene el resultado de la consulta
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new \Exception("No records found for the provided email.");
            }

            // Retorna los datos extraídos como un arreglo asociativo
            return [
                'id' => $result['id'],
                'username' => $result['username'],
                'role' => $result['role'],
                'image' => $result['image'],
                'address' => $result['address'],
            ];
        } catch (\Exception $e) {
            // Registra el error
            error_log($e->getMessage());
            return null; // También devolver null en caso de error
        }
    }

    /**
     * This method checks if the user credentials are valid.
     * @param string $email 
     * @param string $password 
     * @return bool 
     */
    public static function checkCredentials(string $email, string $password): bool
    {
        try {
            // Instancia del usuario y preparación de la consulta
            $user = new User();
            $stmt = $user->db->prepare('SELECT password FROM users WHERE email = :email');

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . implode(" ", $user->db->errorInfo()));
            }

            // Asigna el parámetro `:email` en la consulta
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Ejecuta la consulta y verifica si fue exitosa
            if (!$stmt->execute()) {
                throw new \Exception("Error executing statement: " . implode(" ", $stmt->errorInfo()));
            }

            // Obtiene el resultado de la consulta
            $passwordFromUser = $stmt->fetchColumn();

            return !is_null($passwordFromUser) && password_verify($password, $passwordFromUser);
        } catch (\Exception $e) {
            // Registra el error o devuelve el mensaje de error
            error_log($e->getMessage()); // Registra el error en el log del servidor
            return false;
        }
    }

    /**
     * This method saves a new user in the database.
     * @param array $data 
     * @return bool 
     */
    public static function save(array $data): bool
    {
        try {
            $user = new User();
            $stmt = $user->db->prepare('INSERT INTO users (username, email, password, first_name, last_name, role, image, address) VALUES (:username, :email, :password, :first_name, :last_name, :role, :image, :address)');

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . implode(" ", $user->db->errorInfo()));
            }

            // Asigna los valores a las variables
            $username = $data['userName'];
            $email = $data['email'];
            $password = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 4]);
            $first_name = $data['name'];
            $last_name = $data['lastName'];
            $role = 'user';
            $address = $data['address'];
            $image = $user->saveImage($data['image']);

            // Vincula los parámetros utilizando bindParam o bindValue
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);

            // Ejecuta la consulta y verifica si fue exitosa
            if (!$stmt->execute()) {
                throw new \Exception("Error executing statement: " . implode(" ", $stmt->errorInfo()));
            }

            return true;
        } catch (\Exception $e) {
            // Registra el error o devuelve el mensaje de error
            error_log($e->getMessage()); // Registra el error en el log del servidor
            return false;
        }
    }
}
