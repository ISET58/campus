<?php



$email=$_POST["mail"];

include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";


$usuario=usuarioPorEMAIL($email);

//////////////////////////////////////////////
// si el email no existe en la base de datos
if($usuario==false){

	header('Location: oops.html');
	exit;
}


////////////////////////////////////////////
//si el email existe en la base de datos
//echo "<pre>";
//print_r($usuario);

$uid=$usuario["ID"]."_".time();
$url="campus/frontend/resetpw.php?id=".$uid;


/////////////////////////////////////////////////////////////////////////
// se guarda el uid en la base de datos

actualizarPorID("usuarios", $usuario["ID"], array("verificado"), array($uid));


////////////////////////////////////////////////////////////////////////
/// Se envia el email
$para=$email;
$titulo = 'Resetear password Campus Iset58';

$mensaje = '<html><head>'.
	'<title>Resetear password de campus Iset58</title></head>'.
	'<body><h1>Hola '.$usuario["nombre"].' '.$usuario["apellido"].'</h1>'.
	'Recibimos un pedido para resetear tu password.<br>'.
	'Si no fuiste vos, descarta este mail.<br>'.
	'Si fuiste vos quien hizo el pedido, hace click en el siguiente link.<br><br>'.
	'<a href="'.$url.'">RESETEAR PASSWORD</a><br><br>'.
	'Si por alguna razón el link no anda, copía y pegá en el navegador el que te dejamos acá abajo<br><br>'.
	 $url.
	'<br><br><hr>'.
	'Que tengas un buen día. <a href="campus">iset58rosario.com.ar/campus</a>'.
	'<hr>'.
	'</body></html>';


$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$cabeceras .= 'From: iset58 <no-reply@iset58rosario.com.ar>';
$enviado = @mail($para, $titulo, $mensaje, $cabeceras);



if($enviado){
	
	header('Location: listo.html');
	exit;

}else{

	echo "<h3>Hubo algun problema,intentelo mas tarde</h3>";
    echo "<h3>si el problema continua</h3>";
    echo "<h4>envie un mail a desarrollo@iset58rosario.com.ar</h4>";
}











