<?php



include "../includes/databaseTools.php";


$carreras=getCarreras();

echo "<select name='comboCarreras' id='comboCarreras'>";
echo "<option value='null'>Seleccione una carrera</option>";
foreach($carreras as $car){

   echo "<option value='".$car["ID"]."'>".$car["nombre"]."</option>";
}
echo "</select>";


?>


