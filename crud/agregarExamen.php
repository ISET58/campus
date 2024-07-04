<?php

include_once "../config.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
    $cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
    $offset = $_GET["offset"];


$id = $_GET["id"];
$year = $_GET["year"];
$titulo = $_GET["titulo"];
$carrera = $_GET["carrera"];
$carreraID = $_GET["carreraID"];
$desde = $_GET["desde"];
$hasta = $_GET["hasta"];



include "../includes/databaseTools.php";
include "../includes/generalTools.php";


$campos = array("year", "titulo", "carrera", "carreraID", "fechadesde", "fechahasta", "habilitado", "estado");
$valores = array($year, $titulo, $carrera, $carreraID, $desde, $hasta, "si", "activo");


//si no esta se registra el usuario
insertar('examenes', $campos, $valores);

$tabla = "examenes";
$campos = array("ID", "titulo", "year", "carrera", "fechadesde", "fechahasta", "habilitado", "estado");
$condicion = "estado='activo'";
$plantilla = "examenes";



listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);



?>