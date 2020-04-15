<?php

class Single {

    #region Propiedades
    public $id;
    public $disco_id;
    public $titulo;
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

    #endregion

    #region Métodos

    /**
     * Obtener todos los singles de un disco según el id del disco_id
     */
    public function getSingles($id){

        $album = $this->db->query("SELECT * FROM singles WHERE disco_id = '$id'");
        return $album;

    }
    

    #endregion
   
}