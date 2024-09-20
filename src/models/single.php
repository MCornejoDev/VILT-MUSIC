<?php

require_once "./config/parameters.php";

class Single {

    #region Propiedades
    private $id;
    private $disco_id;
    private $titulo;
    private $duracion;
    private $archivo_musical;
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
     * Get the value of disco_id
     */ 
    public function getDisco_id()
    {
        return $this->disco_id;
    }

    /**
     * Set the value of disco_id
     *
     * @return  self
     */ 
    public function setDisco_id($disco_id)
    {
        $this->disco_id = $disco_id;

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
     * Get the value of duracion
     */ 
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of duracion
     *
     * @return  self
     */ 
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

     /**
     * Get the value of archivo_musical
     */ 
    public function getArchivo_musical()
    {
        return $this->archivo_musical;
    }

    /**
     * Set the value of archivo_musical
     *
     * @return  self
     */ 
    public function setArchivo_musical($archivo_musical)
    {
        $this->archivo_musical = $archivo_musical;

        return $this;
    }

    #endregion

    #region Métodos

    /**
     * Obtener todos los singles de un disco según el id del disco_id
     */
    public function getSingles($id){

        $album = $this->db->query("SELECT * FROM singles WHERE disco_id = '$id'");
        return $album;

    }

    public function save(){
 
        $result = false;
        $sql = "INSERT INTO singles VALUES(NULL,'{$this->getDisco_id()}','{$this->getTitulo()}','{$this->getDuracion()}','{$this->getArchivo_musical()}')";
        $registro = $this->db->query($sql);

        if($registro){
            $result = true;
        }

        return $result;

    }

    /**
     * Función que nos comprueba si el título del single existe en la base de datos.
     */
    public function comprobarTitulo($titulo,$disco_id){
        $result = false;

        $sql = $this->db->query("SELECT * FROM singles WHERE titulo = '$titulo' AND disco_id = '$disco_id'");

        if($sql->num_rows == 0 && $sql){
            $result = true;
        }

        return $result;
    }

    public function obtenerTituloCarpeta($disco_id){
        $sql = $this->db->query("SELECT titulo FROM discos WHERE id = '$disco_id'");
        $titulo = $sql->fetch_object();
        return $titulo->titulo;
    }

    /**
     * Función que nos devuelve el id del último registro creado.
     */
    public function obtenerUltimoId(){
        $id = -1;
        $sql = $this->db->query("SELECT MAX(id) as id FROM singles");
        $id = $sql->fetch_object();
        return $id->id;
    }

    public function subirArchivo(){}

    #endregion
   
}