<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

$apellido=$_GET["apellido"];
$nombre=$_GET["nombre"];
$dni=$_GET["dni"];
$email=$_GET["mail"];
$tipo=$_GET["tipo"];
$password=hash('sha256', $_GET["password"]);



include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("apellido","nombre","dni","email", "password","habilitado", "tipo");
$valores=array($apellido,$nombre,$dni,$email, $password, "si", $tipo);

// se verifica si el email ya esta en la BDD
if(estaEnlaBDD('usuarios','email',$email)){
	// si esta se avisa y no se registra el usuario
	mostrarHTML ("ya-registrado.html", $email);
	exit;	
}
	

//si no esta se registra el usuario
insertar ('usuarios', $campos, $valores);




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


