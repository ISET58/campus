<?php

include_once "../config.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
    $cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
    $offset = $_GET["offset"];

$id = $_GET["id"];


include "../includes/databaseTools.php";


borrarInscripcion($id);

$tabla = "inscripciones";
$campos = array("ID", "year", "titulo", "carrera", "tipo", "habilitado", "estado");
$condicion = "estado='activo' and tipo='reinscripcion'";
$plantilla = "reinscripciones";


listar($tabla, $campos, $plantilla, $condicion);


?>