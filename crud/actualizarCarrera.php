<?php

include_once "../config.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
    $cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
    $offset = $_GET["offset"];

$id = $_GET["id"];
$nombre = $_GET["carrera"];
$duracion = $_GET["duracion"];
$comentario = $_GET["comentario"];



include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos = array("nombre", "duracion", "comentarios", "habilitado", "estado");
$valores = array($nombre, $duracion, $comentario, "si", "activo");

actualizarPorID('carreras', $id, $campos, $valores);



$tabla = "carreras";
$campos = array("ID", "nombre", "duracion", "estado", "habilitado", "comentarios");
$condicion = "estado='activo'";
$plantilla = "carreras";


listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);



?>