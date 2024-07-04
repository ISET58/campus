<?php

include_once "../config.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
	$cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
	$offset = $_GET["offset"];

$year = $_GET["year"];
$titulo = $_GET["titulo"];
$carrera = $_GET["carrera"];
$carreraID = $_GET["carreraID"];



include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos = array("year", "titulo", "carrera", "carreraID", "tipo", "habilitado", "estado");
$valores = array($year, $titulo, $carrera, $carreraID, "ingresante", "si", "activo");

// se verifica si el email ya esta en la BDD
if (estaEnlaBDD('inscripciones', 'titulo', $titulo)) {
	// si esta se avisa y no se registra el usuario
	mostrarHTML("ya-registrado.html", $email);
	exit;
}


//si no esta se registra el usuario
insertar('inscripciones', $campos, $valores);


$tabla = "inscripciones";
$campos = array("ID", "year", "titulo", "carrera", "tipo", "habilitado", "estado");
$condicion = "estado='activo' and tipo='ingresante'";
$plantilla = "ingresantes";



listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);



?>