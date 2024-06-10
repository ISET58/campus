<?php



$db = new sqlite3('campus.db');
$results = $db->query("UPDATE materiasExamenes SET estado = null WHERE id <= 466");



?>