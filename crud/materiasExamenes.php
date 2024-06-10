<?php

include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$examenID=0;
$titulo="";
if(isset($_GET["id"]))$examenID=$_GET["id"];
if(isset($_GET["examen"]))$titulo=$_GET["examen"];



// primero se tiene que ver si hay materias
// en la tbala materiasExamenes con el id
// del examen

$resultado=getMateriaExamenes($examenID);


///////////////////////////////////////////////////////////
// si el resultado es cero entonces no hay ninguna
// materia asociada al id del examen en cuestion
// y se tiene que mostar las materias "limpias"
// desde la tabla materias
if( count($resultado)==0){

	// primero se busca el id del carrera del examen
	$carreraID=getCarreraExamen($examenID);
	$carrreraNombre=getNombreCarrera($carreraID);

    //con el id de carrera se traen todas las materias
    //de esa carrera
    $listaCarreras=listarMateriasPorCarrera($carreraID);

   

    $salida=array();
    $i=0;
    foreach ($listaCarreras as $carrera) {

    	$salida[$i]["nombreMateria"]=$carrera["nombre"];
    	$salida[$i]["materiaID"]=$carrera["ID"];
    	$salida[$i]["examenID"]=$examenID;
    	$salida[$i]["year"]=$carrera["year"];
    	$salida[$i]["fecha"]="";
    	$salida[$i]["hora"]="";
    	$salida[$i]["numero"]=$i;
      	$i++;
    }

}



///////////////////////////////////////////////////////////
// si el resultado es mayor que cero entonces hay 
// materias asociada al id del examen en cuestion
if( count($resultado)>0){

	$listaCarreras=listarMateriasExamen($examenID);

	$salida=array();
    $i=0;
    foreach ($listaCarreras as $carrera) {

        $salida[$i]["nombreMateria"]=getNombreMateria($carrera["materiaID"]);
    	$salida[$i]["materiaID"]=$carrera["materiaID"];
    	$salida[$i]["examenID"]=$carrera["examenID"];
        $salida[$i]["year"]=getYearMateria($carrera["materiaID"]);
    	$salida[$i]["fecha"]=$carrera["fecha"];;
    	$salida[$i]["hora"]=$carrera["hora"];;
    	$salida[$i]["numero"]=$i;
      	$i++;
    }	
    
   
}	


// se carga la plantilla, se reaiza la fusion 
// con los datos y se muestra
$template="../templates/materiasExamenes.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);

// tbs accede solo a variables globales o que
// se hayan declarado en VarRef por eso hay que hacer esto
$TBS->MergeBlock('bloque1',$salida); 
$TBS->Show(); 



?>


