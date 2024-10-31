<?php

namespace App\Http\Services;

use User;

require_once __DIR__ . '../../../Models/User.php';

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
            $stmt = $user->db->prepare('SELECT id, username, role, image, address FROM users WHERE email = ?');

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $user->db->error);
            }

            $stmt->bind_param('s', $email);

            if (!$stmt->execute()) {
                throw new \Exception("Error executing statement: " . $stmt->error);
            }

            $stmt->bind_result($id, $username, $role, $image, $address);

            $stmt->fetch();

            return [
                'id' => $id,
                'username' => $username,
                'role' => $role,
                'image' => $image,
                'address' => $address,
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
            $user = new User();
            $stmt = $user->db->prepare('SELECT password FROM users WHERE email = ?');

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $user->db->error);
            }

            // Bind de los parámetros y comprobación de errores
            if (!$stmt->bind_param('s', $email)) {
                throw new \Exception("Error binding parameters: " . $stmt->error);
            }

            // Ejecuta la consulta y verifica si fue exitosa
            if (!$stmt->execute()) {
                throw new \Exception("Error executing statement: " . $stmt->error);
            }

            $stmt->bind_result(
                $passwordFromUser,
            );

            $stmt->fetch();

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
            $stmt = $user->db->prepare('INSERT INTO users (username, email, password, first_name, last_name, role, image, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

            if (!$stmt) {
                throw new \Exception("Error preparing statement: " . $user->db->error);
            }

            // Assign the values to variables first
            $username = $data['userName'];
            $email = $data['email'];
            $password = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 4]);
            $first_name = $data['name'];
            $last_name = $data['lastName'];
            $role = 'user';
            $address = $data['address'];
            $image = $user->saveImage($data['image']);

            // Bind de los parámetros y comprobación de errores
            if (!$stmt->bind_param('ssssssss', $username, $email, $password, $first_name, $last_name, $role, $image, $address)) {
                throw new \Exception("Error binding parameters: " . $stmt->error);
            }

            // Ejecuta la consulta y verifica si fue exitosa
            if (!$stmt->execute()) {
                throw new \Exception("Error executing statement: " . $stmt->error);
            }

            return true;
        } catch (\Exception $e) {
            // Registra el error o devuelve el mensaje de error
            error_log($e->getMessage()); // Registra el error en el log del servidor
            return false;
        }
    }
}
