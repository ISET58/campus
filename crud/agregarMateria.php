<?php

include_once "../config.php";



$materia=$_GET["materia"];
$year=$_GET["year"];
$carreraID=$_GET["carreraID"];
$carrera=$_GET["carrera"];
$comentario=$_GET["comentario"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("nombre","carrera", "carreraID", "year", "estado","habilitado", "comentarios");
$valores=array($materia, $carrera, $carreraID, $year, "activo", "si", $comentario);

// se verifica si ya existes
if(estaEnlaBDD('materias','nombre',$materia)){
	// si esta se avisa y no se registra el usuario
	mostrarHTML ("ya-registrado.html", $email);
	exit;	
}
	

//si no esta se registra el usuario
insertar ('materias', $campos, $valores);


$tabla="materias";
$campos=array("ID", "nombre", "carrera", "year", "comentarios", "habilitado","estado");
$condicion="estado='activo'";
$plantilla="materias";




listar($tabla, $campos, $condicion,$plantilla);



?>


