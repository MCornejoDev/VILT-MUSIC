<?php


class Usuario {

    #region Propiedades 
    private $id;
    private $nombre_usuario;
    private $email;
    private $password;
    private $nombre;
    private $apellidos;
    private $rol;
    private $imagen;
    private $direccion;

    //Conexión a la base de datos
    private $db;

    #endregion


    public function __construct(){
        $this->db = Database::connect();
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
     * Get the value of nombre_usuario
     */ 
    public function getNombre_usuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Set the value of nombre_usuario
     *
     * @return  self
     */ 
    public function setNombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = $this->db->real_escape_string($nombre_usuario);

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
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
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
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);

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
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $this->db->real_escape_string($imagen);

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

    #endregion

    #region Métodos

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre_usuario()}','{$this->getEmail()}','{$this->getPassword()}','{$this->getNombre()}','{$this->getApellidos()}','user','{$this->getImagen()}','{$this->getDireccion()}')";
        $registro = $this->db->query($sql);
        $result = false;

        if($registro){
            $result = true;
        }

        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        //COMPROBAR SI EXISTE EL USUARIO
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            //VERIFICAR LA CONTRASEÑA
            $verify = password_verify($password,$usuario->password);

            if($verify){
                $result = $usuario;
            }
        }

        return $result;
    }

    #endregion
}