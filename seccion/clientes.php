<?php

class Clientes {
    private $txtID;
    private $txtNombre;
    private $txtApellidopaterno;
    private $txtApellidomaterno;
    private $txtDomicilio;
    private $txtCorreo;

    public function __construct($txtID, $txtNombre, $txtApellidopaterno, $txtApellidomaterno, $txtDomicilio, $txtCorreo) {
        $this->txtID = $txtID;
        $this->txtNombre = $txtNombre;
        $this->txtApellidopaterno = $txtApellidopaterno;
        $this->txtApellidomaterno = $txtApellidomaterno;
        $this->txtDomicilio = $txtDomicilio;
        $this->txtCorreo = $txtCorreo;
    }

    public function getID() {
        return $this->txtID;
    }

    public function getNombre() {
        return $this->txtNombre;
    }

    public function getApellidopaterno() {
        return $this->txtApellidopaterno;
    }

    public function getApellidomaterno() {
        return $this->txtApellidomaterno;
    }

    public function getDomicilio() {
        return $this->txtDomicilio;
    }

    public function getCorreo() {
        return $this->txtCorreo;
    }

    public function setID($txtID) {
        $this->txtID = $txtID;
    }

    public function setNombre($txtNombre) {
        $this->txtNombre = $txtNombre;
    }

    public function setApellidopaterno($txtApellidopaterno) {
        $this->txtApellidopaterno = $txtApellidopaterno;
    }

    public function setApellidomaterno($txtApellidomaterno) {
        $this->txtApellidomaterno = $txtApellidomaterno;
    }

    public function setDomicilio($txtDomicilio) {
        $this->txtDomicilio = $txtDomicilio;
    }

    public function setCorreo($txtCorreo) {
        $this->txtCorreo = $txtCorreo;
    }
}

?>

