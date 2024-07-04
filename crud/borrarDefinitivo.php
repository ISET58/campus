<?php


include_once "../config.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
    $cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
    $offset = $_GET["offset"];

$id = $_GET["id"];
$tipo = $_GET["tipo"];

include "../includes/databaseTools.php";


borrarPorID("usuarios", $id);

$tabla = "usuarios";
$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado", "tipo");
$condicion = "estado='inactivo'";
$plantilla = "papelera";


listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);


?>