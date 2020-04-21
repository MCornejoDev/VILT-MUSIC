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

    /**
     * Obtiene todas las categorias.
     */
    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id ASC");
        return $categorias;
    }

    /**
     * Obtiene el id de una categoria que le pasemos por parámetro.
     */
    public function getIdCategory($categoria){
        $sql = $this->db->query("SELECT id FROM categorias WHERE nombre = '$categoria'");
        
        if($sql->num_rows == 1 && $sql){
            $id = $sql->fetch_object();
        }

        return $id;
    }

    /**
     * Guardaremos una categoría creada por el usuario.
     */
    public function save(){
        $result = false;
        $sql = "";
        $sqlCheck = "SELECT * FROM categorias WHERE nombre = '{$this->getNombre()}'";
        $check = $this->db->query($sqlCheck);
       
        if($check->num_rows == 0){
            $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}')";
            $registro = $this->db->query($sql);
           
        }
        
        if($registro){
            $result = true;
        }

        return $result;
    }

    #endregion

   
}