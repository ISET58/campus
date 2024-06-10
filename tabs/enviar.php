<?php

include_once "../config.php";

?>


<style>
	#mensajeAdmin{
		width: 80%;
		padding: 10px;

	}


	.boton{
		background-color: #e0e094;
		width:fit-content;
		height: 30px;
		line-height: 30px;
		text-align: center;
		margin-left: 0px;
		cursor: pointer;
		padding: 0px 20px;
	}

	.boton:hover{
		transform: scale(1.05);
	}

	.boton:active{
		transform: scale(0.95);
	}

	.rojo{ background-color: red; color:white; }
	.verde{ background-color: green; color:white; }



</style>

<h2>Escriba el mensaje</h2>

<textarea id="mensajeAdmin" rows="10" cols="80">

</textarea>

<div class="boton verde" onclick="enviarMensaje()"   id="enviarmensaje">Enviar Mensaje</div>

<div id="areaCarga"></div>
<script>


	function enviarMensaje(){
		var message = $('textarea#mensajeAdmin').val();
		
        message=encodeURI(message);
        var archivo="crud/enviarmensaje.php?mensaje="+message+"&tipo=alumnos";
        $("#areaCarga").load(archivo);

		
		$('textarea#mensajeAdmin').val("");
	}

</script>


<?php


/*
$cantidad=$paginacion;
$offset=null;

if(isset($_GET["cantidad"]))$cantidad=$_GET["cantidad"];
if(isset($_GET["offset"]))$offset=$_GET["offset"];

include "../includes/databaseTools.php";


$tabla="usuarios";
$campos=array("ID", "apellido", "nombre", "email", "dni","habilitado");
$condicion="tipo ='alumno' and estado='activo' and habilitado='si'";
$plantilla="alumnos";


listar($tabla, $campos, $condicion,$plantilla, $cantidad, $offset);

*/





?>


