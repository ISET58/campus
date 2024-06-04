<?php

include_once 'acceso.php'; 

////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];

$horario=$_GET["horarios"];

if ($horario=="horarioBancaria1"){ $carrera="bancaria"; $year="primero";}
if ($horario=="horarioBancaria2"){ $carrera="bancaria"; $year="segundo";}
if ($horario=="horarioBancaria3"){ $carrera="bancaria"; $year="tercero";}

if ($horario=="horarioTurismo1"){ $carrera="turismo"; $year="primero";}
if ($horario=="horarioTurismo2"){ $carrera="turismo"; $year="segundo";}
if ($horario=="horarioTurismo3"){ $carrera="turismo"; $year="tercero";}

// se completan los datos del archivo en la bdd
$database="../data/horarios.db";

/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////


 $sqlquery= "SELECT * FROM horarios WHERE carrera='".$carrera."' AND yearDeLaCarrera='".$year."'";

    // se realiza la consulta sql    
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos= array();
    while($row = $results->fetch_assoc()){
       $datos[]=$row;
    }

$salida="";
foreach ($datos as $material) {
    $salida.='<div class="tituloHorario">'.$material["titulo"].'</div>';
    $salida.='<div class="descripcionHorario">'.$material["descripcion"].'</div>';
    $salida.='<div class="descripcionHorario">Cargado por: '.$material["nombreCreador"].'</div>';
    $salida.='<embed';
    $salida.=' src="'.$material["url"].'#toolbar=0&navpanes=0&scrollbar=0"';

    $salida.='frameBorder="0"';
    $salida.='scrolling="auto"';
    $salida.='height="800px"';
    $salida.='width="100%"';
    $salida.='></embed>';
}


if (count($datos)==0){
    $salida='<div class="tituloHorario">Todavia no hay horarios cargados para esta division</div>';
}

echo $salida;

//echo "<pre>";
//print_r($datos);


?>