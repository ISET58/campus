<?php

include_once "../config.php";


$id=$_GET["id"];
$titulo=$_GET["titulo"];
$carrera=$_GET["carrera"];
$carreraID=$_GET["carreraID"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("titulo","carrera", "carreraID", "tipo", "habilitado","estado");
$valores=array($titulo, $carrera, $carreraID, "reinscripcion", "si", "activo");


actualizarPorID ('inscripciones', $id, $campos, $valores);



$tabla="inscripciones";
$campos=array("ID", "year", "titulo", "carrera","tipo", "habilitado","estado");
$condicion="estado='activo' and tipo='reinscripcion'";
$plantilla="reinscripciones";


listar($tabla, $campos,$plantilla, $condicion,);



?>


