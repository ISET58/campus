<?php


$apellido=$_POST["apellidos"];
$nombre=$_POST["nombre"];
$email=$_POST["mail"];
$password=hash('sha256', $_POST["passs"]);


include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";



$epochCreado=time();


$campos=array("apellido","nombre","email", "password","habilitado", "tipo","epochCreado","epochEditado");
$valores=array($apellido,$nombre,$email, $password, "no", "profesor",$epochCreado,$epochCreado);

// se verifica si el email ya esta en la BDD
if(estaEnlaBDD('usuarios','email',$email)){
	// si esta se avisa y no se registra el usuario
	mostrarHTML ("ya-registrado.html", $email);
	exit;	
}
	

//si no esta se registra el usuario
$user_id=insertar ('usuarios', $campos, $valores);

$tipo="unicast";
$url=null;
$group_id=null;
$emisor_id=$institucion_id;

////////////////////////
$texto="Hola ".$nombre." ".$apellido." te registraste en el Campus del Iset58 como profesor pero";
$texto.=" todavia no estas habilitado. Mientras tantos podes completar tu perfil.";
$texto.="";
$formato="exito";
$imagen="images_msg/propios/bienvenidos.jpg";
mensaje($user_id, $tipo, $texto, $imagen, $url, $group_id, $emisor_id,$formato);
//sleep (1);

//header('Location: perfil.php');

?>

<style type="text/css">
	
  .registroOK{
  	width:100%;
  }

  .registroOK h2{
  	width:100%;
  	text-align: center;
  }

  .renglon{
  	width:100%;
  	text-align: center;
  	font-size:22px;
  }

</style>


<div class="registroOK">

	<h2>Ahora tenes que esperar la habilitacion de profesor</h2>
	<h2>Pero igual podes entrar al campus</h2>
  <h2>y completar tu perfil</h2><br>
    <h2>Volvé para atras y logeate (arriba a la derecha)</h2>
    <h2>con tu email y el password que elegiste</h2>
    <div class="renglon"><a href="/campus/profesores">Volver al campus</a></div>




</div>	

















