<?php

/**Creamos una clase estática que contendra la conexión a la base de datos */
class Database{
    public static function connect(){
        $db = new mysqli('localhost','root','','cornejo_music');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}