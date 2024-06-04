<?php

include_once 'acceso.php'; 


////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];




$carreraID=$_POST["carreraId"];
$materiasInscriptas=array();
$estadoInscriptas=array();
$regularidades=array();
$fechaExamen=array();

//////////////////////////////////////////
// antes de escribir las materias en las
// que el usuario se inscribio
// se borran las anteriores para hacer una limpieza

borrarIncripcionesExamenes($userID,$carreraID);

foreach ($_POST as $key => $value) {

    if(strpos($key, "materiaID") !== false){
		$partes=explode("-",$key);
		$IDmateria=$partes[1];
		$c="cursado-".$IDmateria;
		$cursado="libre";
		if(isset($_POST[$c]))$cursado="regular";

		$f="fecha-".$IDmateria;
		$fechaRegular="";
		if(isset($_POST[$f]))$fechaRegular=$_POST[$f];

		$campos=array("userID","carreraID","materiaID", "cursado", "FechaRegular","epoch", "habilitado");
		$valores=array($userID,$carreraID,$IDmateria, $cursado, $fechaRegular, time(), "si");

		$materiasInscriptas[]=getNombreMateria($IDmateria);
		$estadoInscriptas[]=$cursado;

		$regularidades[]=$fechaRegular;
		$fechaExamen[]=getFechaExamen($IDmateria);

		insertar ("inscriptosExamenes", $campos, $valores);
     	
	}

	//echo "<h1>$key $value</h1>";
}


$perfil=getUserProfile ($userID);


///////////////////////////////////////////////////////////
// se envia el mail de verificacion de inscripcion
//////////////////////////////////////////////////////////

$carrera=getNombreCarrera($carreraID);


$i=0;
$textoMaterias="";
foreach ($materiasInscriptas as $key => $value) {

      $fecha="";
      if($regularidades[$i]!="") $fecha=" (fecha regularidad declarada ".$regularidades[$i].")";

	  $textoMaterias.= $value." en condicion ".$estadoInscriptas[$i].$fecha."<br>".PHP_EOL;
	  $textoMaterias.= "La fecha de examen es ".$fechaExamen[$i]."<br>".PHP_EOL."<br>".PHP_EOL;

	  
	  
	  
	  $i++;

}




$para = $perfil["email"];

$titulo = 'Confirmación inscripcion materias';

$mensaje = '<html><head>'.
	'<title>Inscripcion Materias</title></head>'.
	'<body><h1>Hola '.$perfil["nombre"].' '.$perfil["apellido"].'</h1>'.
	'Este email es una confirmación de que te inscribiste en los examenes para las siguientes '.
	'materias de la carrera '. $carrera. ' a traves del campus del Iset58'.
	'<hr>'.
	$textoMaterias.
	'<hr>'.
	'Las fechas de examenes en este mail pueden variar asi que consulte la informacion actualizada en el sitio web del iset58'.
	'<hr>'.
	'ATENCION: este sistema aun no verifica la existencia de las correlatividades, por lo tanto '. 
	'aquellos alumnos que no cumplimenten el régimen de correlatividad de cada materia se '. 
	'considerara como no inscripto a la misma y no tendrá valor cualquier evaluación que pueda el docente otorgar.'.
	'Que tengas un buen día. <a href="campus">iset58rosario.com.ar/campus</a>'.
	'</body></html>';



$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$cabeceras .= 'From: iset58 <no-reply@iset58rosario.com.ar>';
$enviado = @mail($para, $titulo, $mensaje, $cabeceras);




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

$inscripciones=cargarInscripciones($userID);


// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/perfil.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);


$TBS->MergeBlock('bloque1',$mensajes); 
$TBS->MergeBlock('bloque2',$inscripciones);
$TBS->Show(); 




?>