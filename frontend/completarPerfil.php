<?php

include_once 'acceso.php'; 



$nombre=$_POST["nombre"];
$apellido=$_POST["apellido"];
$email=$_POST["email"];
$telefono=$_POST["telefono"];
$celular=$_POST["celular"];
$dni=$_POST["dni"];
$fecha_nacimiento=$_POST["fecha_nacimiento"];
$lugar_nacimiento=$_POST["lugar_nacimiento"];
$nacionalidad=$_POST["nacionalidad"];
$estado_civil=$_POST["estado_civil"];
$domicilio_real=$_POST["domicilio_real"];
$localidad=$_POST["localidad"];
$domicilio_temporal=$_POST["domicilio_temporal"];
$localidad_temporal=$_POST["localidad_temporal"];
$nivel_estudios=$_POST["nivel_estudios"];
$estado_estudios=$_POST["estado_estudios"];
$titulo_estudios=$_POST["titulo_estudios"];
$emergencia_llamar=$_POST["emergencia_llamar"];
$emergencia_telefono=$_POST["emergencia_telefono"];
$emergencia_telefono2=$_POST["emergencia_telefono2"];
$empresa_medicina=$_POST["empresa_medicina"];
$telefono_emp_medicina=$_POST["telefono_emp_medicina"];
$comentario=$_POST["comentario"];


////////////////////////////////////////////////////////
// se obtiene el id de usuario de la cookie de session
///////////////////////////////////////////////////////
$partes=explode("_", $_SESSION["sessionID"]);
$userID=$partes[0];



$campos=array("nombre","apellido","email","telefono", "celular","dni", "fecha_nacimiento","lugar_nacimiento","nacionalidad","estado_civil","domicilio_real","localidad","domicilio_temporal","localidad_temporal","nivel_estudios","estado_estudios","titulo_estudios","emergencia_llamar","emergencia_telefono","emergencia_telefono2","empresa_medicina","telefono_emp_medicina","comentario");

$valores=array($nombre,$apellido,$email,$telefono, $celular,$dni, $fecha_nacimiento,$lugar_nacimiento,$nacionalidad,$estado_civil,$domicilio_real,$localidad,$domicilio_temporal,$localidad_temporal,$nivel_estudios,$estado_estudios,$titulo_estudios,$emergencia_llamar,$emergencia_telefono,$emergencia_telefono2,$empresa_medicina,$telefono_emp_medicina,$comentario);

actualizarPorID ("usuarios", $userID, $campos, $valores);


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