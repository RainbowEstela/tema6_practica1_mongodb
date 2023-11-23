<?php

namespace Navidad\modelos;
use \PDO;
use \PDOException;
use MongoDB\Client;

class ConexionBaseDeDatos {

    private $conexion;

    public function __construct() {
    
        $this->conexion = (new Client('mongodb://root:toor@mongo1:27017'))->navidad;
        
    }


    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion = null;
    }
}