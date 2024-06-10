<?php

include_once "../config.php";
include "../includes/databaseTools.php";


$busqueda="";
$tipo="alumnos";
if(isset($_GET["busqueda"]))$busqueda=$_GET["busqueda"];
if(isset($_GET["tipo"]))$tipo=$_GET["tipo"];



$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado");

if($tipo=="alumnos"){
	$condicion=" AND habilitado='si' AND tipo='alumno' AND estado='activo'";
	$plantilla="alumnos";
}

if($tipo=="profesores"){
	$condicion=" AND tipo='profesor' AND estado='activo'";
	$plantilla="profesores";
}

if($tipo=="pendientes"){
	$condicion=" AND habilitado='no' AND tipo='alumno' AND estado='activo'";
	$plantilla="pendientes";
}



buscar($tabla, $campos, $busqueda, $plantilla, $condicion);







?>


