<?php

include_once 'acceso.php'; 
include_once '../conexion.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["sessionID"])) {
    die("No se ha iniciado sesión.");
}

// Obtener el id de usuario de la cookie de sesión
$partes = explode("_", $_SESSION["sessionID"]);
$userID = $partes[0];

// Datos del creador del archivo
$userProfile = getUserProfile($userID);
$IDcreador = $userProfile["ID"];
$nombreCreador = $userProfile["nombre"] . " " . $userProfile["apellido"];

// Nombre y path del archivo
$directorioDestino = "../horarios/";
$nombre = uniqid() . "_" . basename($_FILES['file1']['name']);
$archivoDestino = $directorioDestino . $nombre;
$path = "/campus/horarios/" . $nombre;

$titulo = $_POST["nombreMaterial"];
$descripcion = $_POST["descripcionMaterial"];
$carrera = $_POST["carrera"];
$yearCarrera = $_POST["yearCursado"]; // No convertir a entero, ya que es una cadena de texto
$fecha = date("Y-m-d H:i:s");
$epoch = time();

// Verificar los valores
var_dump($titulo, $descripcion, $carrera, $yearCarrera);



try {
    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $db->prepare("INSERT INTO horarios (
        epoch, 
        fecha,
        url,
        titulo,
        descripcion,
        IDcreador,
        nombreCreador,
        visible,
        carrera,
        yearDeLaCarrera
    ) VALUES (?, ?, ?, ?, ?, ?, ?, 'si', ?, ?)");

    // Vincular parámetros a la consulta
    $stmt->bind_param("issssssss", $epoch, $fecha, $path, $titulo, $descripcion, $IDcreador, $nombreCreador, $carrera, $yearCarrera);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $lastID = $stmt->insert_id;

        // Mover el archivo a la biblioteca
        if (move_uploaded_file($_FILES["file1"]["tmp_name"], $archivoDestino)) {
            // Redirigir después de insertar el registro
            header('Location: mostrarHorariosEsteProfe.php');
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error al insertar el horario: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $db->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
