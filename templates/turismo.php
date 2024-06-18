
<a href="/campus/data/preturismo.xlsx" class="descargarxls">Descargar en formato excel</a>
<br>
<br>


<?php


include "../config.php";
include "../includes/databaseTools.php";
$database = 'iset';

$db = new mysqli($host, $username, $password, $database);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$hora=time()-$duracionSesion;

$results = $db->query("SELECT * FROM inscriptos WHERE carrera='turismo'");


echo "<h3> Pre inscriptos a Adm. Bancaria 2021: </h3>";

echo "<pre>";


//////////////////////////////////////////////
echo 
'<style>'.
'.fila{ width:100%; height:30px; display:flex; justify-content: space-around;}'.
'.caja{ width:20%; overflow: hidden; border: 1px solid gray; text-align:center; line-height:30px;}'.
'.cajah{ width:20%; overflow: hidden; text-align:center; line-height:30px; font-weight:900; font-size:14px }'.
'</style>';
////////////////////////////////////////////


echo '<div class="fila">';
      echo '<div class="cajah" >APELLIDO</div>';
      echo '<div class="cajah">NOMBRE</div>';
      echo '<div class="cajah">DNI</div>';
      echo '<div class="cajah">E-MAIL</div>';
      echo '<div class="cajah">CELULAR</div>';
      echo '<div class="cajah">TRABAJA</div>';
      echo '<div class="cajah">ESUDIOS</div>';
      echo '<div class="cajah">DNI</div>';
      echo '<div class="cajah">DNI</div>';
      echo '<div class="cajah">TITULO</div>';
      echo '<div class="cajah">TITULO</div>';
   echo '</div>';

while ($row = $results->fetch_assoc()) {

     
   echo '<div class="fila">';
      echo '<div class="caja">'.$row["apellido"].'</div>';
      echo '<div class="caja">'.$row["nombre"].'</div>';
      echo '<div class="caja">'.$row["dni"].'</div>';
      echo '<div class="caja">'.$row["email"].'</div>';
      echo '<div class="caja">'.$row["celular"].'</div>';
      echo '<div class="caja">'.$row["trabaja"].'</div>';
      echo '<div class="caja">'.$row["nivel_estudios"].'</div>';
      echo '<div class="caja">'.'<a href="/campus/preinscripcion2021/'.$row["doc1"].'" target="_blank">frente</a>'.'</div>';
      echo '<div class="caja">'.'<a href="/campus/preinscripcion2021/'.$row["doc2"].'" target="_blank">dorso</a>'.'</div>';
      echo '<div class="caja">'.'<a href="/campus/preinscripcion2021/'.$row["titulo1"].'" target="_blank">frente</a>'.'</div>';
      echo '<div class="caja">'.'<a href="/campus/preinscripcion2021/'.$row["titulo2"].'" target="_blank">dorso</a>'.'</div>';
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


<h2 style="margin-bottom: 30px;"> Exportar formato excel</h2>
<a href="/campus/data/preturismo.xlsx" class="descargarxls">Descargar archivo</a>


<?php


$root =(!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';


$url = $root."campus/data/exportpreturismo.php";
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
