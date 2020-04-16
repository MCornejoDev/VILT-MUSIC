<?php

class Categoria{

    #region Propiedades
    private $id;
    private $nombre;
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
        $this->nombre = $nombre;

        return $this;
    }


    #endregion

    #region Métodos

    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id ASC");
        return $categorias;
    }

    public function getIdCategory($categoria){
        $sql = $this->db->query("SELECT id FROM categorias WHERE nombre = '$categoria'");
        
        if($sql->num_rows == 1 && $sql){
            $id = $sql->fetch_object();
        }

        return $id;
    }

    #endregion

   
}