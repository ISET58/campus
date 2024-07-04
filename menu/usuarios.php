<style type="text/css">




</style>


<div class="panelVentana">
	<div class="tituloVentana">Usuarios</div>

	<div class="menu">

		<ul class="menu__tabs">
			<li><a class="active" href="#item-1"><i class="fa fa-users-class"></i>Alumnos</a></li>
			<li><a href="#item-2"><i class="fa fa-user-check"></i>Pendientes</a></li>
			<li><a href="#item-3"><i class="fa fa-user-graduate"></i>Profesores</a></li>
			<li><a href="#item-4"><i class="fas fa-trash"></i>Papelera</a></li>
			<li><a href="#item-5"><i class="fa fa-user-check"></i>Exportar</a></li>
		</ul>

		<section class="menu__wrapper">

			<!--------------------------------------------->
			<article id="item-1" class="menu__item item-active">


			</article>
			<!--------------------------------------------->

			<article id="item-2" class="menu__item">



			</article>

			<!--------------------------------------------->

			<article id="item-3" class="menu__item">


			</article>

			<!--------------------------------------------->

			<article id="item-4" class="menu__item">


			</article>

			<!--------------------------------------------->

			<article id="item-5" class="menu__item">



			</article>


		</section>

	</div>
</div>

<script type="text/javascript">

	// se ejecuta cuando se termina de cargar
	// es como un init de la subventana
	jQuery(function () {
		var activa = jQuery(".active");
		var archivo = "tabs/" + activa.text() + ".php";
		archivo = archivo.toLowerCase();
		console.log(activa[0].hash);
		jQuery(activa[0].hash).load(archivo);

	});





	//////////////////////////////////////////////////////
	// atiende los tabs de las ventanas
	//////////////////////////////////////////////////////
	var jQuerymenu_tabs = jQuery('.menu__tabs li a');
	jQuerymenu_tabs.on('click', function (e) {
		e.preventDefault();
		jQuerymenu_tabs.removeClass('active');
		jQuery(this).addClass('active');

		var archivo = "tabs/" + jQuery(this).text() + ".php";
		archivo = archivo.toLowerCase();


		jQuery(this.hash).load(archivo);
		jQuery('.menu__item').fadeOut(300);
		jQuery(this.hash).delay(300).fadeIn();

	});
</script>