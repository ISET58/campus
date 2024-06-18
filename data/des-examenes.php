<?php



new mysqli($host, $username, $password, $database);
$results = $db->query("UPDATE materiasExamenes SET estado = null WHERE id <= 466");



?>