<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

$id=$_GET["id"];


include "../includes/databaseTools.php";


deshabilitarMateria($id);

$tabla="materias";
$campos=array("ID", "nombre", "carrera", "year", "comentarios", "habilitado","estado");
$condicion="estado='activo'";
$plantilla="materias";




listar($tabla, $campos, $condicion,$plantilla);




?>


