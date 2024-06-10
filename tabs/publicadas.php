<?php 

// se abre la base de datos de novedades
$database="../data/novedades.db";


// se arma la consulta sql
$sqlquery= "SELECT * FROM novedades WHERE activa='si' ORDER BY epoch DESC";

// se realiza la consulta sql    
$results = $db->query($sqlquery);

// se transforma el resultado de la consulta en una array
$datos= array();
while($row = $results->fetch_assoc()){
       $datos[]=$row;
 }

 $plantilla="publicadas";


// se carga la plantilla, se reaiza la fusion 
// con los datos y se muestra
$template="../templates/publicadas.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);

// tbs accede solo a variables globales o que
// se hayan declarado en VarRef por eso hay que hacer esto
$TBS->MergeBlock('bloque1',$datos); 
$TBS->Show(); 



?>