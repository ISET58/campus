<?php

include_once 'acceso.php'; 


////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];




$carreraID=$_POST["carreraId"];
$materiasInscriptas=array();


//////////////////////////////////////////
// antes de escribir las materias en las
// que el usuario se inscribio
// se borran las anteriores para hacer una limpieza

borrarIncripciones($userID,$carreraID);

foreach ($_POST as $key => $value) {

    if(strpos($key, "materiaID") !== false){
		$partes=explode("-",$key);
		$IDmateria=$partes[1];
		$c="cursado-".$IDmateria;
		$cursado="regular";
		if(isset($_POST[$c]))$cursado="regular";

		$campos=array("userID","carreraID","materiaID", "cursado","activo");
		$valores=array($userID,$carreraID,$IDmateria, $cursado,"si");

		$materiasInscriptas[]=getNombreMateria($IDmateria);

		insertar ("inscriptos", $campos, $valores);
     	
	}

	//echo "<h1>$key $value</h1>";
}


$perfil=getUserProfile($userID);


///////////////////////////////////////////////////////////
// se envia el mail de verificacion de inscripcion
//////////////////////////////////////////////////////////

$carrera=getNombreCarrera($carreraID);



$materiasEnviar=implode( "<br>".PHP_EOL , $materiasInscriptas); 

$para = $perfil["email"];

$titulo = 'Confirmación inscripcion materias';

$mensaje = '<html><head>'.
	'<title>Inscripcion Materias</title></head>'.
	'<body><h1>Hola '.$perfil["nombre"].' '.$perfil["apellido"].'</h1>'.
	'<h3>Documento declarado numero:'.$perfil["dni"].'</h3>'.
	'Este email es una confirmación de que te inscribiste en las siguientes '.
	'materias de la carrera '. $carrera. ' a traves del campus del Iset58'.
	'<hr>'.
	$materiasEnviar.
	'<hr>'.
	'Imprimí este Email y presentalo en la Secretaria del Iset58'.
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