<?php


$apellido=$_POST["apellidos"];
$nombre=$_POST["nombre"];
$email=$_POST["mail"];
$password=hash('sha256', $_POST["passs"]);
$clave=$_POST["clave"];

$claveAlamcenada=trim(file_get_contents("../data/clave.txt"));

if($claveAlamcenada!=$clave){
	echo "<h1>La clave de secretaria no es correcta<h1>";
	echo "<h3>Esta clave te la entregan en la secretaria del Iset58<h3>";
	echo "<h3>Si no la tenes, para registrarte la necesitas.<h3>";
    echo "<h3>Acercate al ISet58 y pedila.<h3>";
    exit;

}




include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";



$epochCreado=time();


$campos=array("apellido","nombre","email", "password","habilitado", "tipo","epochCreado","epochEditado");
$valores=array($apellido,$nombre,$email, $password, "no", "alumno",$epochCreado,$epochCreado);

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
$texto="Hola ".$nombre." ".$apellido." te registraste en el Campus del Iset58 pero";
$texto.=" todavia no estas habilitado. Cuando completes tu perfil, y confirmes tu e-mail te habilitaremos para poder anotarte a las carreras y materias";
$texto.="(te enviaremos un email con un link para confirmar tu direccion de e-mail, tenes que hacer click en el link)";
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

	<h2>Ahora tenes que esperar un mail que te enviaremos</h2>
	<h2>Para confirmar tu dirección de email</h2><br>
    <h2>Volvé para atras y logeate (arriba a la derecha)</h2>
    <h2>con tu email y el password que elegiste</h2>
    <div class="renglon"><a href="campus">Volver al campus</a></div>




</div>	

















