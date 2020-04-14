<?php

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
        $result = false;
        
        return $discos;
    }

    /**Devolver un número de discos de la base de datos.*/
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

    public function getCategoria(){
        $result = false;

        return $discos;
    }

    #endregion
}