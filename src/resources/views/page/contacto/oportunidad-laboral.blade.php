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

<h1>Oportunidad Laboral</h1>
<div class="container text-center">
			<p>En esta sección está diseñada para aquellos que quieran incorporarse a nuestro grupo de trabajo. 
					Lo invitamos a completar el formulario y enviar sus datos.</p>

			@section("add_component") 			
				@include("components.select",["title"=>"Sector:","id"=>"sector","name"=>"sector",
					"option"=>["Camaras de Seguridad","Desarrollo","Redes y Servidores","Social Media","Otros"]])
			@endsection
			@include("components.form",["action"=>"someplace","titleForm"=>"Oportunidad Lboral"])
    			  			
				
</div>
@endsection
