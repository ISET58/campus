<?php

include_once "../config.php";
include "../includes/databaseTools.php";


$mensaje="";
$tipo="alumnos";
if(isset($_GET["mensaje"]))$mensaje=$_GET["mensaje"];
if(isset($_GET["tipo"]))$tipo=$_GET["tipo"];

if($mensaje==""){
	echo "El mensaje no se envio porque esta vacio";
	exit;

}

mensaje(0, "broadcast", $mensaje, "", "", "", -1,"exito");

echo "El mensaje fue enviado a las ". date("h:i:sa", time()-(3600*3));





?>


