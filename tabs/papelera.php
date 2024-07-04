<?php

include_once "../config.php";
include "../includes/databaseTools.php";


$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
    $cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
    $offset = $_GET["offset"];

$tabla = "usuarios";
$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado", "tipo");
$condicion = "estado='inactivo'";
$plantilla = "papelera";

listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);



?>