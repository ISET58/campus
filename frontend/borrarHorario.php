<?php
include_once "../conexion.php";
$id = $_GET['id'];

// Verificar que el ID es válido
if (!is_numeric($id) || $id <= 0) {
    die("ID inválido.");
}


try {
    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $db->prepare("DELETE FROM horarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            // Redirigir después de borrar el registro
            header('Location: mostrarHorariosEsteProfe.php');
        } else {
            echo "No se encontró el horario con el ID especificado.";
        }
    } else {
        echo "Error al borrar el horario: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $db->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
