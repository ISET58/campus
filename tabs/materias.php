<?php


include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="materias";
$campos=array("ID", "nombre", "carrera", "carreraId","year", "estado","habilitado", "comentarios");
$condicion="estado='activo'";
$plantilla="materias";


listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);







?>


