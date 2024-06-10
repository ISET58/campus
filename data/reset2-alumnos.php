<?php



$db = new sqlite3('campus.db');
$results = $db->query("UPDATE inscriptos SET activo='no' ");
			  

echo "<pre>";
print_r($results);


?>