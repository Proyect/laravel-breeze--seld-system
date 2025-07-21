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
<div class="container-fluid text-center">
	<h2>Formulario de contacto</h2>
	<p>Para facilitar el relevamiento de datos. Lo invitamos a  completar el siguiente formulario de datos y en breve nos estaremos poniendo en contacto. </p>
	
	@section("add_component") 
	<div class="form-group row">
		@include("components.input",["title"=>"Cantidad de camaras","id"=>"camaras","name"=>"camaras", "type"=>"number"])
		@include("components.select",["title"=>"Calidad de las camaras :","id"=>"calidad","name"=>"calidad",
					"option"=>["No sabe","HD","Full HD","4 K"]])
		@include("components.input",["title"=>"Sup en interiores","id"=>"sup_interiores","name"=>"sup_interiores", "type"=>"number"])
		@include("components.input",["title"=>"Sup en exteriores","id"=>"sup_exteriores","name"=>"sup_exteriores", "type"=>"number"])
		@include('components.radio',["title"=>"Requiere instalacion de alarmas","name"=>"alarma", "id"=>"alarma",
					"option"=>["Si","No"]])
	</div>
	@endsection
			
	@include("components.form",["titleForm"=>"Instalacion de camaras de seguridad"])   
					
			
</div>
@endsection