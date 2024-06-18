<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];


$dni="";
$id=$_GET["id"];
$apellido=$_GET["apellido"];
$nombre=$_GET["nombre"];
if(isset($_GET["dni"]))$dni=$_GET["dni"];
$email=$_GET["mail"];
$tipo=$_GET["tipo"];

$password=$_GET["password"];
if($password!="") $password=hash('sha256', $password);


include "../includes/databaseTools.php";
include "../includes/generalTools.php";


if($password!=""){
	$campos=array("apellido","nombre","dni","email", "password","habilitado", "tipo");
	$valores=array($apellido,$nombre,$dni,$email, $password, "si", $tipo);
}

if($password==""){
	$campos=array("apellido","nombre","dni","email", "habilitado", "tipo");
	$valores=array($apellido,$nombre,$dni,$email,  "si", $tipo);
}




actualizarPorID ('usuarios', $id, $campos, $valores);



$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado");


if($tipo=="alumno"){ 
	$plantilla="alumnos";
	$condicion="tipo ='alumno' and estado='activo' and habilitado='si'";
}

if($tipo=="profesor"){
	$plantilla="profesores";
	$condicion="tipo ='profesor' and estado='activo'";

} 

listar($tabla, $campos,$plantilla,$condicion, $cantidad, $offset);


?>


