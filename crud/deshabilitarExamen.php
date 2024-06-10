<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

$id=$_GET["id"];


include "../includes/databaseTools.php";


deshabilitarExamen($id);

$tabla="examenes";
$campos=array("ID", "titulo", "year", "carrera","fechadesde","fechahasta" , "habilitado","estado");
$condicion="estado='activo'";
$plantilla="examenes";

listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);




?>


