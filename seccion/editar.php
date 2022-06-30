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

$sentenciaSQL = $bd->conexion()->prepare("UPDATE clientes SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, domicilio = :domicilio, correo = :correo WHERE id = :id");
$sentenciaSQL->bindParam(':nombre', $txtNombre);
$sentenciaSQL->bindParam(':apellido_paterno', $txtApellidopaterno);
$sentenciaSQL->bindParam(':apellido_materno', $txtApellidomaterno);
$sentenciaSQL->bindParam(':domicilio', $txtDomicilio);
$sentenciaSQL->bindParam(':correo', $txtCorreo);
$sentenciaSQL->bindParam(':id', $txtID);
$sentenciaSQL->execute();

?>