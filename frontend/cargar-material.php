<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once 'acceso.php'; 


////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];


// dtaos del creador del archivo
$userProfile=getUserProfile($userID);
$IDcreador=$userProfile["ID"];
$nombreCreador=$userProfile["nombre"]." ".$userProfile["apellido"];


// nombre y path del archivo
$directorioDestino="../biblioteca/";
$nombre=$_FILES['file1']['name'];
$archivoDestino = $directorioDestino . $nombre;

$path="/campus/biblioteca/".$nombre;

$titulo=$_POST["nombreMaterial"];
$descripcion=$_POST["descripcionMaterial"];



$carrera=$_POST["carrera"];;
$yearCarrera=$_POST["yearCursado"];;
$fecha=date("Y-m-d H:i:s");
$epoch=time();

// se completan los datos del archivo en la bdd
$database="../data/biblioteca.db";

/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////



$sqlquery="INSERT INTO materiales (
	epoch, 
	fecha,
	url,
	titulo,
	descripcion,
	IDcreador,
	nombreCreador,
	visible,
	carrera,
	yearDeLaCarrera
	) VALUES (
	'$epoch', 
	'$fecha', 
	'$path',
	'$titulo',
	'$descripcion',
	'$IDcreador',
	'$nombreCreador',
	'si',
	'$carrera',
	'$yearCarrera'
	
	)" ;




$results = $db->query($sqlquery);

$lastID=$db->lastInsertRowID();


// se mueve el archivo a la biblioteca
move_uploaded_file($_FILES["file1"]["tmp_name"], $archivoDestino);


header('Location: subirMateriales.php');




?>