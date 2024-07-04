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


habilitarUsuario($id);

$tabla = "usuarios";
$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado");
$condicion = "tipo ='profesor' and estado='activo'";
$plantilla = "profesores";


listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);


?>