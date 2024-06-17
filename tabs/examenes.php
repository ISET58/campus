<?php


include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="examenes";
$campos=array("ID", "titulo", "year", "carrera","fechadesde","fechahasta" , "habilitado","estado");
$condicion="estado='activo'";
$plantilla="examenes";


listar($tabla, $campos,$plantilla,$condicion, $cantidad, $offset);








?>


