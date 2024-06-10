<style type="text/css">

	
	
</style>


<div class="panelVentana">
	<div class="tituloVentana">Inscripción a  examenes</div>

	<div class="menu">
		
		<ul class="menu__tabs">
			<li><a class="active" href="#item-1"><i class="fa fa-user"></i>Examenes</a></li>
			<li><a href="#item-2"><i class="fa fa-user"></i>Inscriptos</a></li>
			
			
			
		</ul>
		<section class="menu__wrapper">
			<article id="item-1" class="menu__item item-active">
				
			</article>
			
			<article id="item-2" class="menu__item">
				
			</article>

			
	
			

		</section>
		
	</div>
</div>

<script type="text/javascript">
	 // se ejecuta cuando se termina de cargar
      // es como un init de la subventana
      $(function() {
          var activa=$(".active");
   		  var archivo="tabs/"+activa.text()+".php";
          archivo=archivo.toLowerCase();
          console.log(activa[0].hash);   
          $(activa[0].hash).load(archivo);
          
	  });



	  

	 //////////////////////////////////////////////////////
      // atiende los tabs de las ventanas 
      //////////////////////////////////////////////////////
      var $menu_tabs = $('.menu__tabs li a'); 
      $menu_tabs.on('click', function(e) {
          e.preventDefault();
          $menu_tabs.removeClass('active');
          $(this).addClass('active');
          
          var archivo="tabs/"+$(this).text()+".php";
          archivo=archivo.toLowerCase();
          

          $(this.hash).load(archivo);
          $('.menu__item').fadeOut(300);
          $(this.hash).delay(300).fadeIn();

      });
</script>