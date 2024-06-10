<?php

include_once 'acceso.php'; 

////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];

$carreraID=$_GET["carrera"];
$carreraNombre=$_GET["carreraNombre"];
$year=$_GET["year"];


$materias=materiasPorCarrera($carreraID, $userID, $year);





// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/materias.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque1',$materias); 

$TBS->Show(); 





?>