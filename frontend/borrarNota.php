<?php

require_once('../conexion.php');

$id = $_GET['id'];

$sqlquery = "DELETE FROM notas WHERE id=" . $id;
$results = $db->query($sqlquery);

if ($db->affected_rows > 0) {
    $lastID = $db->insert_id;
    header('Location: mostrarNotas.php');
} else {
    echo "No se encontró ninguna fila con ID $id.";
}

?>