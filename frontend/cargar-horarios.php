<?php




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
$directorioDestino="../horarios/";
$nombre=uniqid()."_".$_FILES['file1']['name'];
$archivoDestino = $directorioDestino . $nombre;

$path="/campus/horarios/".$nombre;

$titulo=$_POST["nombreMaterial"];
$descripcion=$_POST["descripcionMaterial"];



$carrera=$_POST["carrera"];;
$yearCarrera=$_POST["yearCursado"];;
$fecha=date("Y-m-d H:i:s");
$epoch=time();

// se completan los datos del archivo en la bdd
$database = 'iset';

/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////
// Crear la conexión
$db = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}


$sqlquery="INSERT INTO horarios (
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


//echo "<h3>".$sqlquery."</h3>";

$results = $db->query($sqlquery);

$lastID = $db->insert_id;


// se mueve el archivo a la biblioteca
move_uploaded_file($_FILES["file1"]["tmp_name"], $archivoDestino);


header('Location: mostrarHorariosEsteProfe.php');

?>