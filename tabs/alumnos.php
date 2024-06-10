<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado");
$condicion="tipo ='alumno' and estado='activo' and habilitado='si'";
$plantilla="alumnos";


listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);







?>


