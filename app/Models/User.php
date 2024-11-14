<?php

namespace App\Models;

use App\Database;
use Exception;

/**
 * Class User
 * @package App\Models
 */
class User
{
    #region Propiedades 
    private $id;
    private $userName;
    private $email;
    private $password;
    private $name;
    private $lastName;
    private $rol;
    private $image;
    private $address;

    //Conexión a la base de datos
    public $db;

    #endregion

    public function __construct($id = null, $email = null, $password = null, $name = null, $lastName = null, $rol = null, $image = null, $address = null)
    {
        $this->db = (new Database())->getConnection();
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->rol = $rol;
        $this->image = $image;
        $this->address = $address;
    }

    #region Get y Set
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return password_hash($this->db->quote($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    #endregion

    #region Métodos

    /**
     * Función que nos comprueba que no exista el usuario en la base de datos.
     */
    public function checkUser($userName)
    {
        $sql = $this->db->query("SELECT username FROM users WHERE username = '$userName'");
        $result = false;

        if ($sql && $sql->num_rows > 0) {
            $result = true;
        }

        return $result;
    }

    public function saveImage($img): string
    {
        try {

            $name = uniqid() . '_' . basename($img['name']);
            $folder = BASE_PATH . '/public/img/users';

            if (makeDirectory($folder)) {
                $file = $folder . '/' . $name;
                move_uploaded_file($img['tmp_name'], $file);
            }

            return $name;
        } catch (Exception $e) {
            // Registra el error o devuelve el mensaje de error
            error_log($e->getMessage()); // Registra el error en el log del servidor
            return false;
        }
    }

    public function isAdmin()
    {
        return $this->rol == 'admin';
    }

    public function identityUser()
    {
        return [
            'id' => $this->id,
            'username' => $this->userName,
            'email' => $this->email,
            'rol' => $this->rol,
            'image' => $this->image,
        ];
    }

    #endregion
}
