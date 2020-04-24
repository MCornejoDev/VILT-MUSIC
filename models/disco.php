<?php

require_once "./config/parameters.php";

class Disco {
    
    #region Propiedades

    private $id;
    private $categoria_id;
    private $titulo;
    private $artista;
    private $descripcion;
    private $stock;
    private $precio;
    private $fecha;
    private $imagen;
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
     * Get the value of categoria_id
     */ 
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Set the value of categoria_id
     *
     * @return  self
     */ 
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of artista
     */ 
    public function getArtista()
    {
        return $this->artista;
    }

    /**
     * Set the value of artista
     *
     * @return  self
     */ 
    public function setArtista($artista)
    {
        $this->artista = $artista;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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

    #endregion

    #region Métodos

    /**
     * Devolver el total de discos que hay de la base de datos.
     */
    public function getDiscos(){
        $discos = $this->db->query("SELECT * FROM discos");
        return $discos;
    }

    /**
     * Obtener un disco según el id
     */
    public function getDisco($id){
        $disco = $this->db->query("SELECT * FROM discos WHERE id = '$id'");
        return $disco->fetch_object();
    }

    /**
     * Obtener un array de discos aleatorios de la base de datos.
     */
    public function getDiscosRandom($limit){
        $result = false;
        $discos = $this->db->query("SELECT * FROM discos ORDER BY RAND() LIMIT $limit");
        return $discos;
    }

    /**
     * Obtener todos los discos según un id pasado por parámetro.
     */
    public function getDiscosCategoria($id){
        $discos = $this->db->query("SELECT * FROM discos WHERE categoria_id = '$id->id'");
        return $discos;
    }

    /** 
     * Guardaremos un disco creado por el usuario.
     */
    public function save(){

        $result = false;
       
        $sql = "INSERT INTO discos VALUES(NULL,'{$this->getCategoria_id()}','{$this->getTitulo()}','{$this->getArtista()}','{$this->getDescripcion()}','{$this->getStock()}','{$this->getPrecio()}','{$this->getFecha()}','NULL')";
        $registro = $this->db->query($sql); 

        if($registro){
            $nombre_carpeta = $this->getTitulo();
            $imagen = $this->getImagen();
            $url_carpeta = public_url . "albums/" . $nombre_carpeta;

            if(!is_dir($url_carpeta)){
               $carpeta_creada = mkdir($url_carpeta, 0777, true);

               if($carpeta_creada){
                    $id_imagen = $this->obtenerUltimoId();
                    $imagen_subida = $this->subirImagen($imagen,$url_carpeta,$nombre_carpeta,$id_imagen);

                    if($imagen_subida){
                        $result = true;
                    }
               }
            }
        }

        return $result;
    }

    /**
     * Función que nos comprueba si el título del disco existe en la base de datos.
     */
    public function comprobarTitulo($titulo){
        $result = false;
        
        $sql = $this->db->query("SELECT titulo FROM discos WHERE titulo = '$titulo'");
      
        if($sql->num_rows == 0 && $sql){
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
        $url_public = "public/albums/" . $nombre_carpeta . "/" . $imagen['name'];
      
        if(move_uploaded_file($imagen['tmp_name'],$url)){
            $sql = $this->db->query("UPDATE discos SET imagen = '$url_public' WHERE id = '$id_imagen'");
            $result = true;
        }

        return $result;
    }

    /**
     * Función que nos devuelve el id del último registro creado.
     */
    public function obtenerUltimoId(){
        $id = -1;
        $sql = $this->db->query("SELECT MAX(id) as id FROM discos");
        $id = $sql->fetch_object();
        return $id->id;
    }

    #endregion
}