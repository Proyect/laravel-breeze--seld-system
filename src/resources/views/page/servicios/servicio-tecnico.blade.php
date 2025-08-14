<?php
/*********************************************
	 *  Sitio web infrasoft
	 * https://infrasoft.com.ar/
	 * Salta Capital
	 * Derechos reservados
	 **********************************************/	
	 ?>
@extends('layouts.site')
@section('container')

<div class="container">
	<h1>Servicio Tecnico</h1>
	<p>Brindamos los servicios que requiere acorde a sus necesidades. </p>
	
	 <div class='row'>
	 	@include('components.list-animation',["title"=>"Desarrollo de Sistemas",
					"fa"=>"fab fa-ubuntu",
					"link"=>"servicios.desarrollo-de-software",
					"detail"=>"Sistemas desarrollados con las últimas tecnologías libres, mediantes procesos 
     		estandarizados y correctamente planificados."])    	     

		@include('components.list-animation',["title"=>"Redes y Conectividad",
					"link"=>"servicios.redes",
					"detail"=>"Servicios de monitoreo preventivo, instalación, configuración, 
					backup de datos. Redes cableadas e inalambricas."])
					
		@include('components.list-animation',["title"=>"Auditoría Informática",
					"fa"=>"fas fa-clipboard",
					"link"=>"servicios.servicios",
					"detail"=>"Análisis, Planificación, Determinación de riesgos e incidencias, 
					Ejecución"])
		
		@include('components.list-animation',["title"=>"Copias de seguridad",
					"link"=>"servicios.servicios",
					"detail"=>"Soporte Remoto, Mantenimiento preventivo, Automatizacion de procesos "])
		
		@include('components.list-animation',["title"=>"Consultoría Informática",
					"link"=>"servicios.servicios",
					"detail"=>"Asesoramiento, Gestión de compras,  Estructuración de procesos"])

		@include('components.list-animation',["title"=>"Capacitacion",
					"link"=>"servicios.servicios",
					"detail"=>"Cursos, Nuevos Sistemas, Plataformas Virtuales"])

       	 
	 </div>
	 <!-- End Row -->  
	 
	 <hr />	 
	 @include("page.contacto.formulario-contacto")	
	 
</div>
@endsection