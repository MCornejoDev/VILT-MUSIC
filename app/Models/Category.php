<?php

require_once __DIR__ . '../../../config/db.php';
class Category
{
    #region Properties
    private $id;
    private $name;
    private $db;
    #endregion

    public function __construct()
    {
        $this->db = Database::connect();
    }

    #region Getters and Setters
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

    #endregion

    #region Methods

    /**
     * Retrieves all categories.
     */
    public function getAll()
    {
        return $this->db->query("SELECT * FROM categories ORDER BY id ASC")->fetch_object();
    }

    /**
     * Retrieves the ID of a category passed as a parameter.
     */
    public function getIdCategory($category)
    {
        $sql = $this->db->query("SELECT id FROM categories WHERE name = '$category'");

        if ($sql->num_rows == 1 && $sql) {
            $id = $sql->fetch_object();
        }

        return $id;
    }

    /**
     * Saves a category created by the user.
     */
    public function save()
    {
        $result = false;
        $sql = "";
        $sqlCheck = "SELECT * FROM categories WHERE name = '{$this->getName()}'";
        $check = $this->db->query($sqlCheck);

        if ($check->num_rows == 0) {
            $sql = "INSERT INTO categories VALUES(NULL, '{$this->getName()}')";
            $record = $this->db->query($sql);
        }

        if ($record) {
            $result = true;
        }

        return $result;
    }

    #endregion

}
