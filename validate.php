<?php
$id=$_POST["uname"];
$password=$_POST["upass"];

if ($id=="admini" && $password=="iset-1243")  header("Location: main.php");
else header("Location: backend.php");
  



?>


