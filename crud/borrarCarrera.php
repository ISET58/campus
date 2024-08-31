<?php


include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

$id=$_GET["id"];


include "../includes/databaseTools.php";


borrarCarrera($id);

$tabla="carreras";
$campos=array("ID", "nombre", "duracion", "estado", "habilitado","comentarios");
$condicion="estado='activo'";
$plantilla="carreras";

listar($tabla, $campos,$plantilla, $condicion, $cantidad, $offset);

?>


