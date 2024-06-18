<?php



new mysqli($host, $username, $password, $database);
$results = $db->query("UPDATE inscriptosExamenes SET habilitado='no' WHERE epoch <= ".time());
			  

 header("Location: /campus/main.php");

?>