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


<h2 style="margin-bottom: 30px;"> Archivo de alumnos y materias en formato excel</h2>
<a href="/campus/data/materias-alumnos.xlsx" class="descargarxls">Descargar archivo</a>


<?php


$root =(!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';


$url = $root."campus/data/convertirxls.php";
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

