<?php



/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////
$database="./preinscripciones.db";


///////////////////////////////////////////////////////////////////////
// Se verifica que no se halla inscripto una persona con el mismo dni
// para la misma carrera
///////////////////////////////////////////////////////////////////////
$carrera=$_POST["carrera"];
$dni=str_replace(".", "", $_POST["dni"]);
$columnas = $db->query("SELECT COUNT(*) as count FROM inscriptos WHERE carrera='".$carrera."' and dni='".$dni."';");
$cantidadCol = $columnas->fetchArray();
$cantidad = $cantidadCol['count'];

if($cantidad>0){
	echo "<body style='background: black; color: white;'>";
	echo "<pre>";
	echo "-------------------------------------------".PHP_EOL;
	echo "YA HAY UN USUARIO INSCRIPTO EN ESTA CARRERA".PHP_EOL;
	echo $carrera.PHP_EOL;
	echo "CON EL DNI INGRESADO:".$dni.PHP_EOL;
	echo "-------------------------------------------".PHP_EOL;
	exit;
}

///////////////////////////////////////////////////////////////////////
// Se verifica que no se halla llegado al tope
// de inscriptos por carrera
///////////////////////////////////////////////////////////////////////

$tope=30;
$columnas = $db->query("SELECT COUNT(*) as count FROM inscriptos WHERE carrera='".$carrera."';");
$cantidadCol = $columnas->fetchArray();
$cantidad = $cantidadCol['count'];



$campos=array();
$valores=array();
foreach ($_POST as $key => $value) {



    $valor=$value;
    //se le sacan (si lo pusieron) los puntos al numeros del dni
    if ($key=="dni") $valor=str_replace(".", "", $value);

 	$campos[]=$key;
 	$valores[]=$valor;
}




// el epoch de la creacion
$campos[]='epochCreado';
$valores[]=time();


$errorInscribir=false;


// se arma la string de campos y valores para el sql
$StringValores = "('".implode("', '",  $valores)."')";
$StringCampos ="(". implode(", ",  $campos).")";


$sqlquery="INSERT INTO inscriptos ".$StringCampos." VALUES ".$StringValores." ";
$results = $db->query($sqlquery);

$alumnoID=$db->lastInsertRowID();

if($results==false)$errorInscribir=true;


$directorioDestino="documentos/";

$ext = pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
$archivoDestino = $directorioDestino . $alumnoID."-doc1.".$ext;
move_uploaded_file($_FILES["file1"]["tmp_name"], $archivoDestino);

$sqlquery= "UPDATE inscriptos SET doc1 = '".$archivoDestino."' WHERE ID ='".$alumnoID."'";
$results = $db->query($sqlquery);


$ext = pathinfo(basename($_FILES['file2']['name']), PATHINFO_EXTENSION);
$archivoDestino = $directorioDestino . $alumnoID."-doc2.".$ext;
move_uploaded_file($_FILES["file2"]["tmp_name"], $archivoDestino);

$sqlquery= "UPDATE inscriptos SET doc2 = '".$archivoDestino."' WHERE ID ='".$alumnoID."'";
$results = $db->query($sqlquery);

$directorioDestino="titulos/";

$ext = pathinfo(basename($_FILES['file3']['name']), PATHINFO_EXTENSION);
$archivoDestino = $directorioDestino . $alumnoID."-titulo1.".$ext;
move_uploaded_file($_FILES["file3"]["tmp_name"], $archivoDestino);

$sqlquery= "UPDATE inscriptos SET titulo1 = '".$archivoDestino."' WHERE ID ='".$alumnoID."'";
$results = $db->query($sqlquery);

$ext = pathinfo(basename($_FILES['file4']['name']), PATHINFO_EXTENSION);
$archivoDestino = $directorioDestino . $alumnoID."-titulo2.".$ext;
move_uploaded_file($_FILES["file4"]["tmp_name"], $archivoDestino);

$sqlquery= "UPDATE inscriptos SET titulo2 = '".$archivoDestino."' WHERE ID ='".$alumnoID."'";
$results = $db->query($sqlquery);



if($errorInscribir==false){
	echo "<body style='background: black; color: white;'>";
	echo "<pre>";
	echo "-------------------------------------------".PHP_EOL;
	echo "GRACIAS, fuiste anotado en la base de datos".PHP_EOL;
	echo "de preincripciones 2021 para ".$carrera.PHP_EOL;
	echo "Numero de ID 2810-000".$alumnoID.PHP_EOL;
	echo "Recordá ese numero".PHP_EOL;
	echo "-------------------------------------------".PHP_EOL;
	echo PHP_EOL;
	echo "<a href='http://iset58rosario.com.ar' style='color:white;'>VOLVER A LA PAGINA DEL ISET 58</a>";
}


if($errorInscribir){
	echo "<body style='background: black; color: white;'>";
	echo "<pre>";
	echo "-------------------------------------------".PHP_EOL;
	echo "No se pudo inscribir.".PHP_EOL;
	echo "Hubo un error ".$carrera.PHP_EOL;
	echo "-------------------------------------------".PHP_EOL;
	echo PHP_EOL;
	echo "<a href='http://iset58rosario.com.ar' style='color:white;'>VOLVER A LA PAGINA DEL ISET 58</a>";
}


///////////////////////////////////////////////////////////
// se envia el mail de verificacion de inscripcion
//////////////////////////////////////////////////////////


/*
if($carrera=="bancaria" && $errorInscribir==false){

	$para = $_POST["email"];
	$titulo = 'Pre-inscripcion en lista de espera';
	$mensaje = '<html><head>'.
		'<title>Inscripcion Materias</title></head>'.
		'<body><h1>Hola '.$_POST["nombre"].' '.$_POST["apellido"].'</h1>'.
		'<h3>Usted se encuentra preinscripto en lista de espera '.
		'para la carrera '. $carrera.'</h3>'.
		'<hr>'.
		'Que tengas un buen día. <a href="campus">iset58rosario.com.ar/campus</a>'.
		'</body></html>';

	$cabeceras = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$cabeceras .= 'From: iset58 <no-reply@iset58rosario.com.ar>';
	$enviado = @mail($para, $titulo, $mensaje, $cabeceras);

}

*/


?>