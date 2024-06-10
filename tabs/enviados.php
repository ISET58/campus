<?php

include_once "../config.php";


$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="mensajes";
$campos=array("ID", "texto");
$condicion="";
$plantilla="mensajes";


listarMensajes($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);







?>


