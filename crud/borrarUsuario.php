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

borrarUsuario($id);

$tabla = "usuarios";
$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado");


if ($tipo == "alumno") {
    $plantilla = "alumnos";
    $condicion = "  tipo ='alumno' AND estado='activo' AND habilitado='si'";
}
if ($tipo == "pendientes") {
    $plantilla = "pendientes";
    $condicion = " tipo ='alumno' and estado='activo' and habilitado='no'";
}
if ($tipo == "profesor") {
    $plantilla = "profesores";
    $condicion = " tipo ='profesor' and estado='activo'";
}




listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);



?>