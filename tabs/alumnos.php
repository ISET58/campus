<?php

include_once "../config.php";

$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado");
$condicion="tipo ='alumno' and estado='activo' and habilitado='si'";
$plantilla="alumnos";

$db = new mysqli($host, $username, $password, $database);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
/*
$sql = "SELECT * FROM usuarios";

// Ejecutar la consulta
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // Iterar sobre los resultados
    while($row = $result->fetch_assoc()) {
        // Aquí puedes hacer algo con cada fila, por ejemplo, imprimir sus valores
        echo " - Nombre: " . $row["nombre"] .  " - tipo: " . $row["tipo"] . "<br>" ;
    }
} else {
    echo "No se encontraron resultados.";
}

$querytotal = $db->query("SELECT nombre FROM usuarios  ");
*/

listar($tabla, $campos,$plantilla,$condicion, $cantidad, $offset);






?>