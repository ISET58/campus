<?php

include_once "../config.php";

$cantidad = $paginacion;
$offset = null;

if (isset($_GET["cantidad"]))
	$cantidad = $_GET["cantidad"];
if (isset($_GET["offset"]))
	$offset = $_GET["offset"];
$id = $_GET["id"];

include "../includes/databaseTools.php";


habilitarUsuario($id);


//////////////////////// MENSAJE ///////////////////////////////////////////
$imagen = "images_msg/propios/habilitado.jpg";
$texto = "Hola ya fuiste habilitado";
mensaje($id, "unicast", $texto, $imagen, null, null, $institucion_id, "exito");
////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////
// se envia Mail
/////////////////////////////////////////////////////////////////////////////

$perfil = getUserProfile($id);

$para = $perfil["email"];

$titulo = 'Fuiste habilitado para inscribirte en las materias';

$mensaje = '<html><head>' .
	'<title>Inscripcion Materias</title></head>' .
	'<body><h1>Hola ' . $perfil["nombre"] . ' ' . $perfil["apellido"] . '</h1>' .
	'Este email es para avisarte que ya estas habilitado para inscribirte ' .
	' en las materias que desees cursar (recuerda que deberás tener aprobadas, o al menos regularizadas,  las correlativas anteriores).<br>' .
	'Entrá a: <a href="campus">iset58rosario.com.ar/campus</a>' .
	' con tu email y el password que elegiste y en |Reinscripciones|, elegi las materias.<br><br><br>' .
	'<hr>' .
	'<br>Que tengas un buen día. <a href="campus">iset58rosario.com.ar/campus</a>' .
	'</body></html>';


$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$cabeceras .= 'From: iset58 <no-reply@iset58rosario.com.ar>';
$enviado = mail($para, $titulo, $mensaje, $cabeceras);


//////////////////////////////////////////////////////////////////////////////



$tabla = "usuarios";
$campos = array("ID", "apellido", "nombre", "email", "dni", "habilitado");
$condicion = "tipo ='alumno' and estado='activo' and habilitado='no'";
$plantilla = "pendientes";


listar($tabla, $campos, $plantilla, $condicion, $cantidad, $offset);


?>