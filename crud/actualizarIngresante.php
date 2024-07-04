<?php

include_once "../config.php";


$id = $_GET["id"];
$year = $_GET["year"];
$titulo = $_GET["titulo"];
$carrera = $_GET["carrera"];
$carreraID = $_GET["carreraID"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos = array("year", "titulo", "carrera", "carreraID");
$valores = array($year, $titulo, $carrera, $carreraID);

actualizarPorID('inscripciones', $id, $campos, $valores);


$tabla = "inscripciones";
$campos = array("ID", "year", "titulo", "carrera", "tipo", "habilitado", "estado");
$condicion = "estado='activo' and tipo='ingresante'";
$plantilla = "ingresantes";



listar($tabla, $campos, $plantilla, $condicion);



?>