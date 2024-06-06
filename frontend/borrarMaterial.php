<?php

$id=$_GET['id'];


// se completan los datos del archivo en la bdd
$database="../data/biblioteca.db";

/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////



$sqlquery="DELETE FROM materiales WHERE id=".$id;




$results = $db->query($sqlquery);

$lastID=$db->lastInsertRowID();


header('Location: subirMateriales.php');

?>