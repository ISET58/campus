<?php 

$clave=$_GET['clave'];


file_put_contents("clave.txt", $clave);

echo $clave;

?>