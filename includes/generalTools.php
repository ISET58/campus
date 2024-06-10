<?php




///////////////////////////////////////////////
// funcion para mostrar un archivo
// html de los que estan en la carpeta html
// con hasta cuatro mensajes reemplazables
///////////////////////////////////////////////
function mostrarHTML ($nombre, $mensaje=null, $mensaje1=null, $mensaje2=null, $mensaje3=null){

	// primero se verifica si el nombre termina
	// en .html, si no es asi se lo agrega
	if (strpos($nombre, '.html') === false) {
      $nombre.='.html';
	}


    $leer=file_get_contents( "../htmls/".$nombre);
    if($leer==false){
		echo 'Error Campus DOA: no se encuentra el archivo '.$nombre. ' en generalTools.php';
		exit();
	}

    if($mensaje !=null)	$leer=str_replace('{{mensaje}}',  $mensaje, $leer);
    if($mensaje1!=null)	$leer=str_replace('{{mensaje1}}', $mensaje1, $leer);
    if($mensaje2!=null)	$leer=str_replace('{{mensaje2}}', $mensaje2, $leer);
    if($mensaje3!=null)	$leer=str_replace('{{mensaje3}}', $mensaje3, $leer);
    


	echo $leer;

	
}








?>