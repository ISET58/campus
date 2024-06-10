<?php

include_once 'acceso.php'; 

////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];

$perfil=getUserProfile ($userID);






///////////////////////////////////////////////////
// se calcula el porcentaje en que esta completo 
// el perfil
///////////////////////////////////////////////////
$total=0;
foreach ($perfil as $key => $value) {
	if($value!="") $total++;
}

$porcentaje=floor(($total/count($perfil))*100);
$perfil["porcentaje"]=$porcentaje;



//////////////////////////////////////////////////////////
// si la foto no tiene perfil se pone un perfil generico
//////////////////////////////////////////////////////////
if($perfil["foto"]==null)$perfil["foto"]="images/interface/perfil.png";


////////////////////////////////////////////////////
// se cargan los mensajes para el perfil
///////////////////////////////////////////////////
$mensajes=cargarMensajes($userID);

$inscripciones=cargarReInscripciones($userID);


// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/perfil.html";

if($perfil["tipo"]=="profesor")$template="templates/perfilprofe.html";

include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque1',$mensajes); 
$TBS->MergeBlock('bloque2',$inscripciones);
$TBS->Show(); 





?>