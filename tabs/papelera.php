<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado","tipo");
$condicion="estado='inactivo'";
$plantilla="papelera";


listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);







?>


