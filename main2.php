<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Campus Virtual Iset58</title>

    <link rel="stylesheet" href="css/all.min.css">
    
    <style type="text/css">
    	*{
    		margin:0px;
    		padding:0px;
    	}

    	html, body{
    		width:100%;
    		height: 100%;
    	}

    	#principal{
    		width:100%;
    		min-height: 100%;
    		background-color: rgb(206, 206, 206);
    		font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
    	}

    	#menuBar{
    		position: fixed;
    		top: 0;
    		left:0;
    		height:100%;
    		width:160px;
    		background-color: #23282d;
    		z-index: 9999;
    		-webkit-user-select: none;  
			  -moz-user-select: none;    
			  -ms-user-select: none;      
			  user-select: none;
    	}

    	#areaTrabajo{
    		position: absolute;
    		top: 0;
    		left:0;
    		
    		width:100%;
    		padding-left:170px;
    		box-sizing: border-box;
    		background-color: rgb(206, 206, 206);
    	}

    	.botonMenu{
    		width: 100%;
    		height: 34px;
    		color:rgba(190,190,200,1);
    		font-size: 14px;
    		font-weight: 600;
    		line-height: 34px;
    		cursor: pointer;
    		position:relative;
    		

    	}

    	.botonMenu:hover{
    		background-color: #000000;
    		color:rgba(150,150,200,1);
    		color: white;
    	
    	}


        .botonMenuselected{
        	background-color: rgba(0,115,170,1);
        	color: white;
        }

    	.botonMenu i{
    		font-weight: 800;
    		margin-right:10px;
    		margin-left: 10px;
    		font-size: 16px;

    	}


    	.angulo{
		    right: 0;
		    border: 8px solid transparent;
		    content: " ";
		    height: 0;
		    width: 0;
		    position: absolute;
		    pointer-events: none;
		    border-right-color: #e1e1e1;
		    top: 50%;
		    margin-top: -8px;
		    display:none;
		}

    	.fondo{
    		position:absolute;
    		bottom:10px;
    	}

    	#logo{
    		background-image: url("images/logo.png");
    		background-repeat: no-repeat;
    		background-size: contain;
    		background-position: center;
    		width:100%;
    		height: 80px;
    		margin-bottom: 20px;
    		margin-top: 20px;
    	}


    	/**************************************/
    	/* estilos comunes para las ventanas */
    	/**************************************/
    	.panelVentana{
			width:94%;
			margin-left:2%;
			margin-top:20px;
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
		}

		.tituloVentana{
			width:100%;
			font-size: 24px;
			padding-bottom: 5px;
			/*border-bottom: solid 0.5px rgba(0,0,0,0.8);*/
			color: rgba(0,0,0,0.6);
			text-transform: uppercase;
			font-weight: 600;
			-webkit-user-select: none;  
			-moz-user-select: none;    
			-ms-user-select: none;      
			user-select: none;

		}

    /**************************************/
    /* Tabs TABS tAbs TaBS                */
    /**************************************/
    .menu__tabs {
      list-style: none;
      overflow: hidden;
    }
    .menu__tabs li {
      float: left;
      margin-right: 2px;
      font-size: 16px;
    }
    .menu__tabs a {
      padding: 5px 15px 5px 15px;
      background: #333b48;
      display: inline-block;
      color: #FFF;
      text-decoration: none;
      -webkit-border-radius: 4px 4px 0 0;
      -moz-border-radius: 4px 4px 0 0;
      border-radius: 4px 4px 0 0;
      -webkit-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      transition: all 0.3s ease;
      -webkit-box-shadow: inset 0 -2px 5px rgba(0,0,0,0.2);
      -moz-box-shadow: inset 0 -2px 5px rgba(0,0,0,0.2);
      box-shadow: inset 0 -2px 5px rgba(0,0,0,0.2);
    }
    .menu__tabs a:hover {
      background: #515a68;
    }
    .menu__tabs a.active {
      color: #333b48;
      background: #FFF;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }
    .menu__tabs a.active i {color: #000000;}
    .menu__tabs a i {
      margin-right: 6px;
      font-size: 18px;
      color: #aaaaaa;
    }

    /*--------------------------
    * MENU WRAPPER
    ---------------------------*/
    .menu {
      margin: 10px auto;
      width: 100%;
      position: relative;
    }
    .menu__wrapper {
      padding: 2em;
      position: relative;
      z-index: 400;
      background: #FFF;
      min-height: 300px;
      -webkit-border-radius: 0 4px 4px 4px;
      -moz-border-radius: 0 4px 4px 4px;
      border-radius: 0 4px 4px 4px;
    }
    
    .menu__wrapper .menu__item {
      line-height: 1.3;
      color: #76716f;
      display: none;
    }
    .menu__wrapper .menu__item.item-active {
      display: block;
    }

    /********************************/
    /* el dialogo modal             */
    /********************************/

      .panelModal {
          display: flex;
          justify-content: center;
          background-color: rgba(0,0,0,0.5);
          position: absolute;
          left: 0px;
          top:0px;
          right: 0px;
          bottom: 0px;
          z-index: 9999;
          display: none;
          
    }

      .Modal{
        position:absolute;
        width:500px;
        height:200px;
        background-color: #23282d;
        margin-top:150px;
        box-shadow: 5px 10px 18px #888888;
        -webkit-user-select: none;  
        -moz-user-select: none;    
        -ms-user-select: none;      
        user-select: none;
        
        
      }

      
      .tituloModal{
        width:100%;
        text-align: center;
        font-size: 20px;
        margin-top:40px;
        color: white;
      }

      .noModal{
        width:50%;
        height: 50px;
        border-top: 1px solid white;
        border-right: 1px solid white;
        color: white;
        position:absolute;
        left:0px;
        bottom:0px;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
      }

      .noModal:hover{
        background-color: rgba(255,20,20,0.9);

      } 

      .noModal:active{
        background-color: rgba(255,255,255,0.9);
        color:black;

      }

      .siModal{
        width:50%;
        height: 50px;
        border-top: 1px solid white;
        
        color: white;
        position:absolute;
        right:0px;
        bottom:0px;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
      }

      .siModal:hover{
        background-color: rgba(20,180,20,0.9);

      } 

      .siModal:active{
        background-color: rgba(255,255,255,0.9);
        color:black;

      }

    /********************************/
    /* Fin del dialogo modal        */
    /********************************/
    

    </style>
  
  </head>

  <body>
  	<!-------- html ------------>
  	<div id="principal">
  		
  		<div id="menuBar">
  			<div id="logo"></div>
  			<div class="botonMenu"><i class="fal fa-tachometer-alt"></i>Dashboard<div class="angulo"></div></div>
  			<div class="botonMenu"><i class="fal fa-users"></i>Usuarios<div class="angulo"></div></div>
			  <div class="botonMenu"><i class="fal fa-calendar"></i>Calendario<div class="angulo"></div></div>
  			<div class="botonMenu"><i class="fal fa-graduation-cap"></i>Materias<div class="angulo"></div></div>
  			<div class="botonMenu"><i class="fal fa-edit"></i>Examenes<div class="angulo"></div></div>
  			<div class="botonMenu"><i class="fal fa-school"></i>Inscripciones<div class="angulo"></div></div>
        <div class="botonMenu"><i class="fal fa-newspaper"></i>Novedades<div class="angulo"></div></div>
  			<div class="botonMenu"><i class="fal fa-cog"></i>Configuracion<div class="angulo"></div></div>
  			<div class="botonMenu fondo"><i class="fal fa-power-off"></i>salir<div class="angulo"></div></div>

  		</div>
  		</div>
  		
  		<div id="areaTrabajo">
  			
  		</div>
  			

      
  	</div>

    <div class="panelModal">
      <div class="Modal">
        <div class="tituloModal">xxxxxxxxxxxxxxxxxxxxxxx</div>
        <div class="siModal" onclick="xx">SI</div>
        <div class="noModal" onclick="xx">NO</div>
      </div>
    </div>


  	<!-------- scripts ------------>
    <script src="js/jquery-3.3.1.min.js"></script>

    <script type="text/javascript">
    	
      ///////////////////////////////////////////////
      // se ejecuta cuando se termino de cargar la
      // pagina (incluidas imagenes etc.)
      // bueo para poner un loader y sacarlo  aca  
      //////////////////////////////////////////////
      if (window.addEventListener) window.addEventListener("load", inicio, false);
      else if (window.attachEvent) window.attachEvent("onload", inicio);
      else window.onload = inicio;

      ////////////////////////////////////////////////////////
      // funcion de inicio
      ////////////////////////////////////////////////////////  
      function inicio(){
        // primero se carga el dashboard
        $("#areaTrabajo").load( "menu/dashboard.php" );
        $(".botonMenu" ).removeClass("botonMenuselected");
        $(".angulo").hide();
        var primero=$(".botonMenu:first");
        primero.find(".angulo").show();
        primero.toggleClass("botonMenuselected");


      }


      //////////////////////////////////////////////////////
      // atiende los botones del menu principal 
      // de la derecha
      //////////////////////////////////////////////////////
    	$(".botonMenu" ).click(function() {
    		$(".botonMenu" ).removeClass("botonMenuselected");
    		$(".angulo").hide();
    		$(this).find(".angulo").show();
    		$(this).toggleClass("botonMenuselected");

    		var item=$(this).text();

    		switch(item) {
    			  case "Dashboard":
    			    $("#areaTrabajo").load( "menu/dashboard.php" );
    			    break;

    			  case "Usuarios":
    			     $("#areaTrabajo").load( "menu/usuarios.php" );
    			    break;

    			  
    			  case "Calendario":
    			     $("#areaTrabajo").load( "menu/calendario.html?v2" );
    			    break;

    			  
    			  case "Materias":
    			    $("#areaTrabajo").load( "menu/materias.php" );
    			    break;

    			  case "Examenes":
    			    $("#areaTrabajo").load( "menu/examenes.php?v1" );
    			    break;
    			  
    			  case "Inscripciones":
    			    $("#areaTrabajo").load( "menu/inscripciones.php" );
    			    break;

            case "Novedades":
               //$("#areaTrabajo").load( "menu/novedades.php" );
               $("#areaTrabajo").load( "wp-admin/edit.php/?autologin_code=j33uzdD9zVTh3PieO3JLUJO3015q2Mhp" );


               //window.location.href = "wp-admin/edit.php/?autologin_code=j33uzdD9zVTh3PieO3JLUJO3015q2Mhp";
               
              break;    

    			  case "Configuracion":
    			     $("#areaTrabajo").load( "menu/configuracion.php" );
    			    break;  
    			   
    			  case "salir":
    			     salirCampus();
    			    break;
    			   
    			   default:
    			    // code block
			  }

    		console.log($(this).text());
  	  });


    ////////////////////////////////////////////////////
    // llama a la ventana modal si/no
    // para ver si queres salir
    ////////////////////////////////////////////////////  
    function salirCampus(){
      $(".tituloModal").text("¿Quiere salir del administrador?");
      $(".siModal").attr("onclick","salir()");
      $(".noModal").attr("onclick","quedarse()");
      $(".panelModal").css("display","flex");
    

    }

    // salir del campus
    function salir(){
      window.location.href ="index.php";
    }

    // quedarse en el campus
    function quedarse(){
      $(".panelModal").css("display","none");
    }
      

    </script>
    



  </body>
</html>