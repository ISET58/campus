<?php

include_once "../config.php";



$titulo=$_GET["titulo"];
$carrera=$_GET["carrera"];
$carreraID=$_GET["carreraID"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("titulo","carrera", "carreraID", "tipo", "habilitado","estado");
$valores=array($titulo, $carrera, $carreraID, "reinscripcion", "si", "activo");

// se verifica si ya existes
if(estaEnlaBDD('inscripciones','titulo',$titulo)){
	// si esta se avisa y no se registra el usuario
	mostrarHTML ("ya-registrado.html", $email);
	exit;	
}
	

//si no esta se registra el usuario
insertar ('inscripciones', $campos, $valores);


$tabla="inscripciones";
$campos=array("ID", "year", "titulo", "carrera","tipo", "habilitado","estado");
$condicion="estado='activo' and tipo='reinscripcion'";
$plantilla="reinscripciones";




listar($tabla, $campos, $condicion,$plantilla);



?>


