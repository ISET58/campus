<?php



$userID=$_POST["userID"];
$password=$_POST["pass"];
$password=hash('sha256', $password);


include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";


////////////////////////////////////////////////////////////////////////
// se guarda el nuevo password en la base de datos datos

actualizarPorID("usuarios", $userID, array("verificado","password" ), array("no",$password));

header('Location: relogin.html');

?>