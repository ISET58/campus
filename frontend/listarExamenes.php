<?php

include_once 'acceso.php'; 

////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];


$inscripciones=cargarExamenes($userID);



$mensaje="";
// si no hay inscipciones entonces estan desabilitadas
if(count($inscripciones)==0){

  $mensaje="La inscripcion a examenes ya cerró";

}



// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/examenes.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque2',$inscripciones); 

$TBS->Show(); 





?>