<?php



new mysqli($host, $username, $password, $database);
$results = $db->query("UPDATE inscriptos SET activo='no' ");
			  

echo "<pre>";
print_r($results);


?>