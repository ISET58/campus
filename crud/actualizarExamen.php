<?php

include_once "../config.php";


$id=$_GET["id"];
$year=$_GET["year"];
$titulo=$_GET["titulo"];
$carrera=$_GET["carrera"];
$carreraID=$_GET["carreraID"];
$desde=$_GET["desde"];
$hasta=$_GET["hasta"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("year","titulo", "carrera", "carreraID", "fechadesde", "fechahasta");
$valores=array($year,$titulo, $carrera, $carreraID, $desde, $hasta);

actualizarPorID ('examenes', $id, $campos, $valores);


$tabla="examenes";
$campos=array("ID", "titulo", "year", "carrera","fechadesde","fechahasta" , "habilitado","estado");
$condicion="estado='activo'";
$plantilla="examenes";


listar($tabla, $campos, $condicion,$plantilla);



?>


