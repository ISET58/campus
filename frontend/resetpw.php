<?php

$uid=$_GET["id"];


include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";


$usuario=usuarioPorUID($uid);

// se carga la plantilla, se realiza la fusion 
// con los datos y se muestra
$template="templates/repassword.html";
include_once('../includes/tbs_class.php');
$TBS = new clsTinyButStrong;
$TBS->LoadTemplate($template);
$TBS->Show(); 


?>