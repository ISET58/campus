<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once 'acceso.php';

// Verificar si se ha proporcionado un ID válido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta de eliminación
    $sqlquery = "DELETE FROM materiales WHERE id=" . $id;

    // Ejecutar la consulta
    $results = $db->query($sqlquery);

    if (!$results) {
        die("Error al intentar eliminar el material: " . $db->error);
    }

    // Redireccionar después de eliminar el material
    header('Location: subirMateriales.php');
    exit;
} else {
    echo "ID no proporcionado.";
}
?>
