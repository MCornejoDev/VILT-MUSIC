<?php

require_once __DIR__ . '../../../config/db.php';

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
    private $db;

    #endregion

    public function __construct($id = null, $email = null, $password = null, $name = null, $lastName = null, $rol = null, $image = null, $address = null)
    {
        $this->db = Database::connect();
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
        $this->userName = $this->db->real_escape_string($userName);

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
        $this->email = $this->db->real_escape_string($email);

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
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
        $this->name = $this->db->real_escape_string($name);

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
        $this->lastName = $this->db->real_escape_string($lastName);

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
        $this->rol = $this->db->real_escape_string($rol);

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
        $this->address = $this->db->real_escape_string($address);

        return $this;
    }

    #endregion

    #region Métodos

    public function isValid(array $data)
    {
        // Usar array_walk para llenar el array de errores
        array_walk($data, function ($value, $key) use (&$errors) {
            if (empty($value)) { // Si el valor es vacío, nulo o falso
                $errors[$key] = []; // Agregar la clave al array de errores
            }
        });

        $hasErrors = empty($errors);

        if (!$hasErrors) {
            addToBag('errors', $errors);
        }

        return $hasErrors;
    }

    public function save()
    {
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password, first_name, last_name, role, image, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        // Assign the values to variables first
        $username = $this->getUserName();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $first_name = $this->getName();
        $last_name = $this->getLastName();
        $role = $this->getRol();
        $image = 'asa';
        $address = $this->getAddress();

        // Now pass the variables to bind_param
        $stmt->bind_param(
            'ssssssss',
            $username,
            $email,
            $password,
            $first_name,
            $last_name,
            $role,
            $image,
            $address
        );

        return $stmt->execute();


        // if ($record) {
        //     $folderName = $this->getUserName();
        //     $image = $this->getImage();
        //     $folderUrl = BASE_PATH;
        //     var_dump($folderName, $image, $folderUrl);

        //     die();

        //     //public_url . "usuarios/" . $folderName;

        //     if (!is_dir($folderUrl)) {
        //         $carpeta_creada = mkdir($folderUrl, 0777, true);

        //         if ($carpeta_creada) {
        //             $imageId = $this->getLastId();
        //             $imageUploaded = $this->uploadImage($image, $folderUrl, $folderName, $imageId);

        //             if ($imageUploaded) {
        //                 $result = true;
        //             }
        //         }
        //     }

        //     $result = true;
        // }

        // return $result;
    }

    public function login()
    {
        $email = $this->email;
        $password = $this->password;

        $stmt = $this->db->prepare('SELECT id,username,password,first_name,last_name,role,image,address FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $stmt->bind_result(
            $id,
            $username,
            $passwordFromUser,
            $first_name,
            $last_name,
            $role,
            $image,
            $address
        );

        $stmt->fetch();

        if (!is_null($passwordFromUser) && password_verify($password, $passwordFromUser)) {
            $this->setId($id);
            $this->setUserName($username);
            $this->setName($first_name);
            $this->setLastName($last_name);
            $this->setRol($role);
            $this->setImage($image);
            $this->setAddress($address);
            return true;
        }

        return;
    }

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

    /**
     * Función que nos sube la imagén en la carpeta correspondiente y nos actualiza la columna imagen
     * de la tabla discos
     */
    public function uploadImage($image, $folderUrl, $folderName, $imageId)
    {
        $result = false;
        $url = $folderUrl . "/" . basename($image['name']);
        $url_public = "public/usuarios/" . $folderName . "/" . $image['name'];

        if (move_uploaded_file($image['tmp_name'], $url)) {
            $sql = $this->db->query("UPDATE usuarios SET imagen = '$url_public' WHERE id = '$imageId'");
            $result = true;
        }

        return $result;
    }

    /**
     * Función que nos devuelve el id del último registro creado.
     */
    public function getLastId()
    {
        $id = -1;
        $sql = $this->db->query("SELECT MAX(id) as id FROM usuarios");
        $id = $sql->fetch_object();
        return $id->id;
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
