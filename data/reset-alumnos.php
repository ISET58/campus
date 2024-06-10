<?php



$db = new sqlite3('campus.db');
$results = $db->query("UPDATE inscriptosExamenes SET habilitado='no' WHERE epoch <= ".time());
			  

 header("Location: /campus/main.php");

?>