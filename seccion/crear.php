<?php 

include("../config/bd.php");

$bd = new BasedeDatos("localhost", "examen", "root", "");
$bd->conexion();

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellidopaterno = (isset($_POST['txtApellidopaterno'])) ? $_POST['txtApellidopaterno'] : "";
$txtApellidomaterno = (isset($_POST['txtApellidomaterno'])) ? $_POST['txtApellidomaterno'] : "";
$txtDomicilio = (isset($_POST['txtDomicilio'])) ? $_POST['txtDomicilio'] : "";
$txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo'] : "";
$estado = 1;

$sentenciaSQL = $bd->conexion()->prepare("INSERT INTO clientes (nombre, apellido_paterno, apellido_materno, domicilio, correo, estado) VALUES (:nombre, :apellido_paterno, :apellido_materno, :domicilio, :correo, :estado)");
$sentenciaSQL->bindParam(':nombre', $txtNombre);
$sentenciaSQL->bindParam(':apellido_paterno', $txtApellidopaterno);
$sentenciaSQL->bindParam(':apellido_materno', $txtApellidomaterno);
$sentenciaSQL->bindParam(':domicilio', $txtDomicilio);
$sentenciaSQL->bindParam(':correo', $txtCorreo);
$sentenciaSQL->bindParam(':estado', $estado);
$sentenciaSQL->execute();

?>