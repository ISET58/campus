<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

$nombre=$_GET["carrera"];
$duracion=$_GET["duracion"];
$comentario=$_GET["comentario"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("nombre","duracion","comentarios", "habilitado", "estado");
$valores=array($nombre,$duracion,$comentario, "si", "activo");

// se verifica si el email ya esta en la BDD
if(estaEnlaBDD('carreras','nombre',$nombre)){
	// si esta se avisa y no se registra el usuario
	mostrarHTML ("ya-registrado.html", $email);
	exit;	
}
	

//si no esta se registra el usuario
insertar ('carreras', $campos, $valores);



$tabla="carreras";
$campos=array("ID", "nombre", "duracion", "estado", "habilitado","comentarios");
$condicion="estado='activo'";
$plantilla="carreras";


listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);



?>


