<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once 'acceso.php'; 

// se obtiene el id de usuario de la cookie de session
$partes = explode("_", $_SESSION["sessionID"]);
$userID = $partes[0];

// datos del creador del archivo
$userProfile = getUserProfile($userID);
$IDcreador = $userProfile["ID"];
$nombreCreador = $userProfile["nombre"] . " " . $userProfile["apellido"];

// nombre y path del archivo
$directorioDestino = "../biblioteca/";
$nombre = $_FILES['file1']['name'];
$archivoDestino = $directorioDestino . $nombre;

$path = "/campus/biblioteca/" . $nombre;

$titulo = $_POST["nombreMaterial"];
$descripcion = $_POST["descripcionMaterial"];
$carrera = $_POST["carrera"];
$yearCarrera = $_POST["yearCursado"];
$fecha = date("Y-m-d H:i:s");
$epoch = time();

// Conexión a la base de datos MySQL usando MySQLi
$host = 'localhost';
$database = 'iset';
$username = 'root';
$password = '';

$db = new mysqli($host, $username, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$sqlquery = "INSERT INTO materiales (
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
)";

if ($db->query($sqlquery) === TRUE) {
    $lastID = $db->insert_id;
} else {
    die("Error: " . $sqlquery . "<br>" . $db->error);
}

// se mueve el archivo a la biblioteca
if (move_uploaded_file($_FILES["file1"]["tmp_name"], $archivoDestino)) {
    echo "El archivo se ha subido correctamente.";
} else {
    echo "Hubo un error al subir el archivo.";
}

$db->close();

header('Location: subirMateriales.php');
exit;
?>
