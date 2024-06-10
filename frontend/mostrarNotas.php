<?php

include_once 'acceso.php';
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