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
$database="../data/horarios.db";

/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////
$db = new SQLite3($database) or die('no se puede abrir la base de datos'. $database);

 $sqlquery= "SELECT * FROM horarios WHERE IDcreador='".$userID."'";

    // se realiza la consulta sql    
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos= array();
    while($row = $results->fetchArray(SQLITE3_ASSOC)){
       $datos[]=$row;
    }



// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/mostrarHorarios.html";


include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque1',$datos); 
$TBS->Show(); 



?>