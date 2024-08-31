<?php

include_once 'acceso.php'; 


$carrera="general";
$year="general";

////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];


$biblioteca=$_GET["biblioteca"];

if ($biblioteca=="bibliotecaBancaria1"){ $carrera="bancaria"; $year="primero";}
if ($biblioteca=="bibliotecaBancaria2"){ $carrera="bancaria"; $year="segundo";}
if ($biblioteca=="bibliotecaBancaria3"){ $carrera="bancaria"; $year="tercero";}

if ($biblioteca=="bibliotecaTurismo1"){ $carrera="turismo"; $year="primero";}
if ($biblioteca=="bibliotecaTurismo2"){ $carrera="turismo"; $year="segundo";}
if ($biblioteca=="bibliotecaTurismo3"){ $carrera="turismo"; $year="tercero";}

// datos del creador del archivo
$perfil=getUserProfile($userID);


/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////
$database = 'iset';
$db = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}



 $sqlquery= "SELECT * FROM materiales WHERE carrera='".$carrera."' AND yearDeLaCarrera='".$year."'";

    // se realiza la consulta sql    
    $results = $db->query($sqlquery);


    // se realiza la consulta sql    
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos= array();
    while($row = $results->fetch_assoc()){
       $datos[]=$row;
    }


if (count($datos)==0){
    $salida='<div class="tituloHorario" style="text-align:center;">Todavia no hay materiales cargados para</div>';
    $salida.='<h2 style="text-align:center; width:100%;">'.$year.' '.$carrera.'</h2>';
    echo $salida;
    exit;
}



// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/biblioteca.html";



include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque1',$datos); 
$TBS->Show(); 



?>