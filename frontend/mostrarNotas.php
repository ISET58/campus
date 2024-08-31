<?php

include_once 'acceso.php'; 


////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];


// dtaos del creador del archivo
$perfil=getUserProfile($userID);

$nombreProfesor=$perfil["nombre"]." ".$perfil["apellido"];

// se completan los datos del archivo en la bdd
$database = 'iset';

/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////
$db = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}


 $sqlquery= "SELECT * FROM notas";

    // se realiza la consulta sql    
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos= array();
    while($row = $results->fetch_assoc()){
       $datos[]=$row;
    }



// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/mostrarNotas.html";


include_once('../includes/tbs_class.php');
require_once('../conexion.php');

$partes = explode("_", $_SESSION["sessionID"]);
$userID = $partes[0];
$perfil = getUserProfile($userID);
$nombreProfesor = $perfil["nombre"] . " " . $perfil["apellido"];

$sqlquery = "SELECT * FROM notas";
$results = $db->query($sqlquery);

if ($results === false) {
   die("Error en la consulta: " . $db->error);
}

$datos = array();
while ($row = $results->fetch_assoc()) {
   $datos[] = $row;
}

$db->close();

$template = "templates/mostrarNotas.html";
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);
$TBS->MergeBlock('bloque1', $datos);
$TBS->Show();

?>