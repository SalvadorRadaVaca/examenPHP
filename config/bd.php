<?php

class BasedeDatos {

    private $host;
    private $bd;
    private $usuario;
    private $contrasenia;
    public $conexion;

    public function __construct($host, $bd, $usuario, $contrasenia) {
        $this->host = $host;
        $this->bd = $bd;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
    }

    public function conexion() {
        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->bd", $this->usuario, $this->contrasenia);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $this->conexion;
    }
}

?>