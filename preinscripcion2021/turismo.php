<?php



echo "<body style='background: black; color: white;'>";
echo "<pre>";
echo "".PHP_EOL;
echo "#################################################################".PHP_EOL;
echo "#                                                               #".PHP_EOL;
echo "#    YA SE COMPLETO EL CUPO DE INSCRIPCION PARA ESTA CARRERA    #".PHP_EOL;
echo "#                                                               #".PHP_EOL;
echo "#################################################################".PHP_EOL;
echo PHP_EOL;
echo "<a href='http://iset58rosario.com.ar' style='color:white;'>VOLVER A LA PAGINA DEL ISET 58</a>";
exit;



$tope=3000;
/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////
$database="./preinscripciones.db";
$db = new SQLite3($database) or die('no se puede abrir la base de datos'. $database);

///////////////////////////////////////////////////////////////////////
// Se verifica que no se halla llegado al tope
// de inscriptos por carrera
///////////////////////////////////////////////////////////////////////
$columnas = $db->query("SELECT COUNT(*) as count FROM inscriptos WHERE carrera='turismo';");
$cantidadCol = $columnas->fetchArray();
$cantidad = $cantidadCol['count'];

/*
if($cantidad>$tope){
	echo "<body style='background: black; color: white;'>";
	echo "<pre>";
	echo "".PHP_EOL;
	echo "#################################################################".PHP_EOL;
	echo "#                                                               #".PHP_EOL;
	echo "#    YA SE COMPLETO EL CUPO DE INSCRIPCION PARA ESTA CARRERA    #".PHP_EOL;
	echo "#                                                               #".PHP_EOL;
	echo "#################################################################".PHP_EOL;
	echo PHP_EOL;
    echo "<a href='http://iset58rosario.com.ar' style='color:white;'>VOLVER A LA PAGINA DEL ISET 58</a>";
	exit;
}

*/





// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/turismo.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);

$TBS->Show(); 





?>