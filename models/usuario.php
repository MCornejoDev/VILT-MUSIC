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
        $this->imagen = $imagen;

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
        $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre_usuario()}','{$this->getEmail()}','{$this->getPassword()}','{$this->getNombre()}','{$this->getApellidos()}','{$this->getRol()}','NULL','{$this->getDireccion()}')";
        $registro = $this->db->query($sql);
        $result = false;

        if($registro){
            $nombre_carpeta_user = $this->getNombre_usuario();
            $imagen = $this->getImagen();
            $url_carpeta = public_url . "usuarios/" . $nombre_carpeta_user;

            if(!is_dir($url_carpeta)){
                $carpeta_creada = mkdir($url_carpeta,0777,true);

                if($carpeta_creada){
                    $id_imagen = $this->obtenerUltimoId();
                    $imagen_subida = $this->subirImagen($imagen,$url_carpeta,$nombre_carpeta_user,$id_imagen);
                    
                    if($imagen_subida){
                        $result = true;
                    }
                }
            }

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

    /**
     * Función que nos comprueba que no exista el usuario en la base de datos.
     */
    public function compruebaUsuario($nombre_usuario){
        $sql = $this->db->query("SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombre_usuario'");
        $result = false;
        
        if($sql && $sql->num_rows > 0){
            $result = true;
        }

        return $result;
    }

    /**
     * Función que nos sube la imagén en la carpeta correspondiente y nos actualiza la columna imagen
     * de la tabla discos
     */
    public function subirImagen($imagen,$url_carpeta,$nombre_carpeta,$id_imagen)
    {   
        $result = false;
        $url = $url_carpeta . "/" . basename($imagen['name']);
        $url_public = "public/usuarios/" . $nombre_carpeta . "/" . $imagen['name'];
      
        if(move_uploaded_file($imagen['tmp_name'],$url)){
            $sql = $this->db->query("UPDATE usuarios SET imagen = '$url_public' WHERE id = '$id_imagen'");
            $result = true;
        }

        return $result;
    }

      /**
     * Función que nos devuelve el id del último registro creado.
     */
    public function obtenerUltimoId(){
        $id = -1;
        $sql = $this->db->query("SELECT MAX(id) as id FROM usuarios");
        $id = $sql->fetch_object();
        return $id->id;
    }

    #endregion
}