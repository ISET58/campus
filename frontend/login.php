<?php

// REPORTE DE ERRORES ACTIVADO
// PARA QUE NO TIRE SOLO ERROR 500
error_reporting(E_ALL);
ini_set('display_errors', 'On');


$email = $_POST["mail"];
$password = hash('sha256', $_POST["pass"]);


include "../includes/databaseTools.php";
include "../includes/generalTools.php";



$userID = login($email, $password);
if (!$userID) {

	mostrarHTML("login-no-OK");
	exit;
}


////////////////////////////////////////////
// si llego hasta aca es porque el
// email y password son correctos

$guid = uniqid($userID . "_campus_", true);

guardarGUID($guid, $userID);


session_start();
$_SESSION["sessionID"] = $guid;


header("Location: perfil.php");






?>