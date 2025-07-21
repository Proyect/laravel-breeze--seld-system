<?php
   /*********************************************
	 *  Sitio web infrasoft
	 * Autor: Ariel Marcelo Diaz
	 * https://infrasoft.com.ar/
	 * Tel: +5493872204925
	 * Salta Capital
	 * Derechos reservados
	 **********************************************/
?>
@extends('layouts.site')

@section('container')

<div class="container-fluid">
	<h1>Contacto</h1>
	<div class="row">		
        <p> Por cualquier consulta, duda o sugerencia dejamos a su disposición los siguientes medios de contacto: </p>
        <div class="col-xl-7 col-lg-7 col-md-7">
        <ul >
			
			<li><b>Telefono:</b>
                    <p> (+54) 387 2204925 <img src='media/img/contacto/claro.png' alt='Contacto linea Claro' />
                    					<img src='media/img/contacto/whatsapp.png' alt='Contacto Whatsapp' /></p>
            </li>       
			<li><b>Horario de atencion:</b>
                    <p> Lunes a Viernes de</p>
                    <p> 8.00 a 14.00 hs y 16.00 a 18.00 hs</p>
                    <p>Atencion por turnos telefonico previo</p>
             </li>
			<li><b>Medios Alternativos:</b></li>
			<li>
					<a href='https://www.facebook.com/infrasofts' target="_blank">
						<img src='media/img/contacto/face2.gif' alt='https://www.facebook.com/infrasofts' /></a>
					<a href='https://twitter.com/infra_soft' target="_blank">
						<img src='media/img/contacto/twitter.gif' alt='https://twitter.com/infra_soft' /></a>
					<a href='index.php/sitios/contacto/'>
					<img src='media/img/contacto/skype2.gif' alt='contacto.php' /></a>
			</li>
		</ul>
		</div>
		<div class="col-xl-5 col-lg-5 col-md-5"> <!--
		<div class="iframe_map" name="iframe_map" id="iframe_map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2154.5235354282213!2d-65.4107681883822!3d-24.745335917879064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sar!4v1560973928855!5m2!1ses!2sar" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div> -->
		</div>
		<hr />
		<div class="container text-center">
			<h2>Formulario de contacto</h2>
			@include("components.form")			  		
				
		</div>
	</div>
</div>
@endsection


