<?php 

$id=$_GET["id"];
$accion=$_GET["accion"];

if($accion=="despublicar") $estado="no";
if($accion=="publicar") $estado="si";



// se abre la base de datos de novedades
$database="../data/novedades.db";
$db = new SQLite3($database) or die('no se puede abrir la base de datos'. $database);



// se arma la consulta sql para actualizar el estado de publicacion
$sqlquery= "UPDATE novedades SET publicada='{$estado}' WHERE id='{$id}' ";

// se realiza la consulta sql    
$results = $db->query($sqlquery);




// ahora se arma la consulta sql para reflejar el nuevo estado
$sqlquery= "SELECT * FROM novedades WHERE activa='si' ORDER BY epoch DESC";

// se realiza la consulta sql    
$results = $db->query($sqlquery);

// se transforma el resultado de la consulta en una array
$datos= array();
while($row = $results->fetchArray(SQLITE3_ASSOC)){
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