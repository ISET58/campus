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


deshabilitarUsuario($id);

////////////////////////
$imagen = "images_msg/propios/deshabilitado.jpg";
$url = null;
$group_id = null;
$emisor_id = $institucion_id;
$texto = "Hola por alguna razon fuiste deshabilitado. Comunicate con la secretaria";
$formato = "alerta";
mensaje($id, "unicast", $texto, $imagen, $url, $group_id, $emisor_id, $formato);
////////////////////////

$tabla = "usuarios";
$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado");

$plantilla = "alumnos";

if ($tipo == "alumnos")
    $condicion = "tipo ='alumno' and estado='activo' and habilitado='si'";
if ($tipo == "profesores")
    $condicion = "tipo ='profesor' and estado='activo'";

$plantilla = $tipo;


listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);




?>