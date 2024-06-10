<?php


include "../includes/databaseTools.php";

$datos=listarDatos();

$clave=trim(file_get_contents("../data/clave.txt"));


include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../templates/dashboard.html');
$TBS->Show(); 






?>


