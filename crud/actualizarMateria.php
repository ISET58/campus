<?php

include_once "../config.php";


$id=$_GET["id"];
$materia=$_GET["materia"];
$year=$_GET["year"];
$carreraID=$_GET["carreraID"];
$carrera=$_GET["carrera"];
$comentario=$_GET["comentario"];


include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$campos=array("nombre","carrera", "carreraID", "year", "comentarios");
$valores=array($materia, $carrera, $carreraID, $year, $comentario);



actualizarPorID ('materias', $id, $campos, $valores);


$tabla="materias";
$campos=array("ID", "nombre", "carrera", "year", "comentarios", "habilitado","estado");
$condicion="estado='activo'";
$plantilla="materias";





listar($tabla, $campos,$plantilla,$condicion);



?>


