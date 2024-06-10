<style type="text/css">
	.registro_form div { 
		margin-bottom: 15px; 
	}
	
	.registro_form input:required:valid, 
	.registro_form select:required:valid {
    	background: #fff url(images/valid.png) no-repeat 98% center;
    	box-shadow: 0 0 5px #5cd053;
    	border-color: #5374b3;
	}
	
	.registro_form input:required, 
	.registro_form select:required {
    	background: #fff url(images/asterisco.png) no-repeat 98% center;
	}

	.registro_form input[type='text'], 
	.registro_form select {
	    padding: 7px 6px;
	    border: 1px solid #CED5D7;
	    resize: none;
	    box-shadow: 0 0 0 3px #EEF5F7;
	    margin: 5px 0;
	    color: #5374b3;
	}

	.registro_form input {
    	width: 100%;
    	padding: 30px;
	}

	.formulario {
	    width: 400px;
	    margin-right: auto;
	    margin-left: auto;
	    margin-top: 50px;
	    margin-bottom: 50px;
	    background-color: beige;
	    padding: 10px;
	}

	.formulario h2{
		width:100%;
		text-align: center;
		font-family: sans-serif;
		box-sizing: border-box;
	}

	.formulario h3{
		width:100%;
		text-align: center;
		font-family: sans-serif;
		font-weight: 500;
		font-size: 14px;
		margin-top:-10px;
		padding:5px 20px 5px 20px;
		box-sizing: border-box;
	}

	button.submit {
	    background-color: #8fbae6;
	    background: -webkit-gradient(linear, left top, left bottom, from(#3958a2), to(#5374b3));
	    background: -webkit-linear-gradient(top, #3958a2, #5374b3);
	    background: -moz-linear-gradient(top, #3958a2, #5374b3);
	    background: -ms-linear-gradient(top, #3958a2, #5374b3);
	    background: -o-linear-gradient(top, #3958a2, #5374b3);
	    background: linear-gradient(top, #3958a2, #5374b3);
	    border: 0px solid #3958a2;
	    color: white;
	    font-weight: bold;
	    padding: 6px 20px;
	    text-align: center;
	    margin-left: 50%;
    	transform: translateX(-50%);
	}



</style>




<!----- HTML --->

<div class="formulario">
	<form name="frmRegistro" action="registrarseBack.php" method="post" class="registro_form" onsubmit="return ValidarRegistro()">
	    <h2>Información del Registrante</h2>
	    <h3>Para registrarte y poder ingresar, necesitas completar todos los datos que abajo te pedimos.</h3>
	    <div><input placeholder="Apellido" name="apellido" type='text' value='' required /></div>
	    <div><input placeholder="Nombres" name="nombre" type='text' value='' required /></div>
	    <div><input placeholder="D.N.I." name="dni" type='text' value='' required /></div>
	    <div><input placeholder="Email" name="mail" type='text' value='' required /></div>
	    <div><input placeholder="Password" name="clave" type='text' value='' required /></div>
	    <div><input placeholder="Repetir password" name="claverep" type='text' value='' required /></div>
	    <div><button class="submit" value="Registrarse" name="btnEnviar" type="submit">Registrarse</button></div>
	</form>
</div>


<script language="javascript">
	    
function ValidarRegistro(){
		   
		    if(document.frmRegistro.apellido.value == '')
		    {
			    alert("Debe ingresar su Apellido");
			    document.frmRegistro.apellido.focus();
			    return false;
		    } 
		  
		    if(document.frmRegistro.nombre.value == '')
		    {
			    alert("Debe ingresar su Nombre");
			    document.frmRegistro.nombre.focus();
			    return false;
		    }
		     if(document.frmRegistro.dni.value == '')
		    {
			    alert("Debe ingresar su dni");
			    document.frmRegistro.dni.focus();
			    return false;
		    } 
		    
		    if (!/^([0-9])*$/.test(document.frmRegistro.dni.value))
		    {
			    alert("Dni debe ser un número");
			    document.frmRegistro.dni.focus();
			    return false;
		    } 
		  
		    if(document.frmRegistro.mail.value == '')
		    {
			    alert("Debe ingresar su dirección de correo electronico.");
			    document.frmRegistro.mail.focus();
			    return false;
		    }

		    if(document.frmRegistro.mail.value.indexOf("@",0) == -1 || document.frmRegistro.mail.value.indexOf(".",0) == -1)
		    {
			    alert("Su dirección de correo no esta bien escrita.");
			    document.frmRegistro.mail.focus();
			    return false;
		    }

		    if(document.frmRegistro.clave.value == '')
		    {
			    alert("Debe ingresar un Password.");
			    document.frmRegistro.clave.focus();
			    return false;
		    }
		    
		    if(document.frmRegistro.claverep.value == '')
		    {
			    alert("Debe repetir el password.");
			    document.frmRegistro.claverep.focus();
			    return false;
		    }
		    
		    if(document.frmRegistro.clave.value != document.frmRegistro.claverep.value)
		    {
			    alert("El password y la repeticion no son iguales.");
			    document.frmRegistro.clave.focus();
			    return false;
		    }
		    
}
	    
</script>
