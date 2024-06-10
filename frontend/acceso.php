<?php


include "../config.php";
include "../includes/databaseTools.php";

session_start();


if(!verificarsesion($_SESSION["sessionID"])){
	echo "La sesion expiró";
	header('Location: /campus/');
	exit;

}


?>