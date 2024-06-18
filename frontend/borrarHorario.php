<?php

$id=$_GET['id'];


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


$sqlquery="DELETE FROM horarios WHERE id=".$id;




$results = $db->query($sqlquery);
$lastID = $db->insert_id;


header('Location: mostrarHorariosEsteProfe.php');

?>