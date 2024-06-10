<?php


include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

$id=$_GET["id"];
$tipo=$_GET["tipo"];

include "../includes/databaseTools.php";


borrarUsuario($id);

$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado");


if($tipo=="alumnos") $condicion="tipo ='alumno' and estado='activo' and habilitado='si'";
if($tipo=="pendientes") $condicion="tipo ='alumno' and estado='activo' and habilitado='no'";
if($tipo=="profesores") $condicion="tipo ='profesor' and estado='activo'";

$plantilla=$tipo;


listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);



?>


