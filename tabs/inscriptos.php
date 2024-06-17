
<a href="/campus/data/examenes.xlsx" class="descargarxls">Descargar en formato excel</a>
<a href="/campus/data/reset-alumnos.php" class="descargarxls" onclick="alert('Seguro los quiere borrar');">Borrar inscriptos examenes anteriores</a>
<br>
<br>


<?php


include "../config.php";
include "../includes/databaseTools.php";
$database = 'iset';

$db = new mysqli($host, $username, $password, $database);
$hora=time()-$duracionSesion;

$results = $db->query("SELECT * FROM inscriptosExamenes WHERE habilitado='si'");


echo "<h3> Inscripcion a examenes: </h3>";

echo "<pre>";


//////////////////////////////////////////////
echo 
'<style>'.
'.fila{ width:100%; height:30px; display:flex; justify-content: space-around;}'.
'.caja{ width:20%; overflow: hidden; border: 1px solid gray; text-align:center; line-height:30px;}'.
'.cajah{ width:20%; overflow: hidden; text-align:center; line-height:30px; font-weight:900; font-size:14px }'.
''.
''.
''.
''.

''.
''.
''.
''.
''.
''.
''.
''.
''.
''.
''.
''.
'</style>';
////////////////////////////////////////////


echo '<div class="fila">';
      echo '<div class="cajah" >ALUMNO</div>';
      echo '<div class="cajah" style="width:30%;">MATERIA</div>';
      echo '<div class="cajah">CARRERA</div>';
      echo '<div class="cajah"  style="width:10%;">CONDICION</div>';
      echo '<div class="cajah">FECHA REGULARIZACION</div>';
      echo '<div class="cajah">MAIL</div>';
      echo '<div class="cajah">SE ANOTO EN</div>';
   echo '</div>';

while ($row = $results->fetch_assoc()) {

   $userID=$row["userID"];
   $perfil=getUserProfile($userID);

   $nombre=$perfil["nombre"];
   $apellido=$perfil["apellido"];
   $carrera=getNombreCarrera($row["carreraID"]);
   $materia=getNombreMateria($row["materiaID"]);
   $cursado=$row["cursado"];
   $FechaRegular=$row["FechaRegular"];
   $fechaInscripcion=date("d/m/Y H:i",$row["epoch"]);

   
   echo '<div class="fila">';
      echo '<div class="caja">'.$nombre.' '.$apellido.'</div>';
      echo '<div class="caja" style="width:30%;">'.$materia.'</div>';
      echo '<div class="caja" >'.$carrera.'</div>';
      echo '<div class="caja" style="width:10%;">'.$cursado.'</div>';
      echo '<div class="caja">'.$FechaRegular.'</div>';
      echo '<div class="caja">enviado</div>';
      echo '<div class="caja">'.$fechaInscripcion.'</div>';
   echo '</div>';
   
 
   


}




?>


<style type="text/css">
   .descargarxls{
      text-decoration: none;
      background-color: rgba(0,255,0,0.7);
      text-align: center;
      padding: 10px 20px

   }

   .descargarxls:hover{
      
      background-color: rgba(0,180,0,0.9);
      color:white;
      

   }
   
</style>


<h2 style="margin-bottom: 30px;">Exportar formato excel</h2>
<a href="/campus/data/examenes.xlsx" class="descargarxls">Descargar archivo</a>


<?php


$root =(!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';


$url = $root."campus/data/exportarExamenes.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if (200==$retcode) {
        echo "<br><br>El archivo de exportacion se generó el: ".date ("d/m/Y",time())." a las ".date ("H:i",time());
    } else {
        echo "<br><br> No se genero el archivo";
        echo "<br><br>Curl error: ".curl_error($ch);
    }



?>
