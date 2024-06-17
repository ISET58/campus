<?php


$root =(!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

					      
$url = $root."campus/data/exportar-reinscripciones.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);



include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="inscripciones";
$campos=array("ID", "year", "titulo", "carrera","tipo", "habilitado","estado");
$condicion="estado='activo' and tipo='reinscripcion'";
$plantilla="reinscripciones";


listar($tabla, $campos,$plantilla,$condicion, $cantidad, $offset);







if ($retcode== 200) {
        echo "<br><br>El archivo de exportacion se generó el: ".date ("d/m/Y",time())." a las ".date ("H:i",time());
    } else {
        echo "<br><br> No se genero el archivo";
        echo "<br><br>Curl error: ".curl_error($ch);
    }







?>


