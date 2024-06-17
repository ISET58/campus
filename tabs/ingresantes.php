<?php


include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="inscripciones";
$campos=array("ID", "year", "titulo", "carrera","tipo", "habilitado","estado");
$condicion="estado='activo' and tipo='ingresante'";
$plantilla="ingresantes";


listar($tabla, $campos,$plantilla,$condicion, $cantidad, $offset);








?>


