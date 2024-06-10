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
$examenID=$_GET["examenID"];


$materias=examenesPorCarrera($carreraID, $userID, $year);


$materiasExamenes=listarMateriasExamen($examenID);


$salida=array();
$i=0;
foreach ($materias as $mat) {
	$salida[$i]=$mat;
    foreach ($materiasExamenes as $exam){
    	if($salida[$i]["ID"]==$exam["materiaID"]){
            $salida[$i]["fecha"]="";
            if ($exam["fecha"]!=""){
			$date=date_create($exam["fecha"]);
    		$salida[$i]["fecha"]="el examen es el ". date_format($date,"d/m/Y")." a las ".$exam["hora"]." horas";
    		}
    		
    	}
    }

 $i++;

}


//echo "<pre>";
//print_r($salida);
//exit;



// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/materiasExamenes.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque1',$salida); 

$TBS->Show(); 





?>