<?php

include_once "../config.php";
include "../includes/databaseTools.php";
include "../includes/generalTools.php";

$enviadas=$_POST;


$cantidad=count($enviadas)/4;


// primero se borran todas las materias asociadas
// al examen en cuestion (Ya que se las va a actualizar)ç
$examenID=$enviadas["idexamen0"];
borrarMateriasExamen($examenID);

for($i=0;$i<$cantidad;$i++){

   $materiaID=$enviadas["idmateria".$i];
   $examenID=$enviadas["idexamen".$i];
   $fecha=$enviadas["fecha".$i];
   $hora=$enviadas["hora".$i];

 

   $campos=array("examenID","materiaID","fecha","hora");
   $valores=array($examenID,$materiaID,$fecha, $hora);

   insertar ('materiasExamenes', $campos, $valores);

   echo "MateriaID= ".$materiaID."<br>";
   echo "examenID= ".$examenID."<br>";
   echo "Fecha= ".$fecha."<br>";
   echo "hora= ".$hora."<br>";


}


?>


