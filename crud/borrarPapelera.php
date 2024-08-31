<?php

include_once "../config.php";
include "../includes/databaseTools.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
    $cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
    $offset = $_GET["offset"];

$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado", "tipo");
$plantilla = "papelera";

borrarTodos();

$tabla="usuarios";
$condicion="estado= inactivo ";
listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);


?>