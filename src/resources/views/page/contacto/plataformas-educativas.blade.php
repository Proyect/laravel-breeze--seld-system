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
<div class="container">
	<h1>Formulario de contacto</h1>
	@section('add_component')
	<div class="form-group row">
		@include("components.select",["title"=>"Plataforma:","id"=>"plataforma","name"=>"plataforma",
				"option"=>["Classroom","Moodle","Chamilo","Otros"]])
		@include("components.input",["title"=>"Cant. de Aulas","id"=>"classroom","name"=>"classroom",
				"type"=>"number"])
		@include("components.input",["title"=>"Cant. de Profesores","id"=>"teacher","name"=>"teacher",
				"type"=>"number"])
		@include("components.input",["title"=>"Cant. de Alumnos","id"=>"student","name"=>"student",
				"type"=>"number"])
		@include("components.select",["title"=>"Requiere Capacitacion:","id"=>"training","name"=>"training",
				"option"=>["Si","No"]])
		@include("components.select",["title"=>"Requiere Soporte tecnico:","id"=>"technical-support","name"=>"technical-support",
				"option"=>["Si","No"]])
		@include("components.select",["title"=>"Plataforma:","id"=>"plataforma","name"=>"plataforma",
		"option"=>["Classroom","Moodle","Chamilo","Otros"]])
	</div>
	@endsection
	@include("components.form",["titleForm"=>"plataformas-educativas"]) 
</div>
@endsection