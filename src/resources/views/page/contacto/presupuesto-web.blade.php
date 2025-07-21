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
	<h1>Presupuesto Web</h1>
                    <p>Para Facilitar la descripción del sitio que usted necesita,  desarrollamos un 
                formulario de consulta de presupuesto para el desarrollo de su sitio con una serie de
                pregunta para conocer sus requerimientos y la extensión de su proyecto.</p>

                <p>Esto permitirá  poder calcular con más exactitud el presupuesto requerido para el 
                desarrollo de su página o sistema Web.</p>
       <p>Importante, Los Campos marcados con (*) son Obligatorios</p>
       <h2>Datos Personales</h2>
	   @section('add_component')
	   	<h2>Requerimientos Generales:</h2>
		   <div class="form-group row">
	   		
			   @include("components.select",["title"=>"Urgencia para Desarrollar:",
			   			"id"=>"urgencia","name"=>"urgencia","option"=>["Baja", "Intermedia","Alta"]])
				@include("components.select",["title"=>"Tipo de Sitio :",
					"id"=>"tipo_sitio","name"=>"tipo_sitio","option"=>["Baja", "Intermedia","Alta"]])
				@include("components.select",["title"=>"Dispone del Contenido :",
					"id"=>"material","name"=>"material","option"=>["Si", "No"]])				
		   </div>
		   <div class="form-group row">
				<h4>Informacion que contendra su Sitio:</h4>
				<div class="form-group row">
					@include("components.checkbox",["title"=>"Institucionales",
						"id"=>"institucional","name"=>"institucional"])
					@include("components.checkbox",["title"=>"Catalogo de Productos o Servicios",
						"id"=>"catalogo","name"=>"catalogo"])
					@include("components.checkbox",["title"=>"Galeria de Imagenes",
						"id"=>"galeria","name"=>"galeria"])
		   		</div>
		   </div>
		   <div class="form-group row">
				@include("components.checkbox",["title"=>"Documentacion/Manuales",
					"id"=>"manuales","name"=>"manuales"])
				@include("components.checkbox",["title"=>"Acceso privado a contenidos",
					"id"=>"acceso_privado","name"=>"acceso_privado"])
				@include("components.checkbox",["title"=>"Encriptacion de datos",
					"id"=>"encriptacion","name"=>"encriptacion"])
				@include("components.checkbox",["title"=>"Otros Datos",
					"id"=>"otros","name"=>"otros"])
		   </div>
		   <div class="form-group row">
				<h3>Requerimientos de Su Sitio </h3>
				@include("components.input",["title"=>"Cantidad de Seciones",
					"id"=>"sessiones","name"=>"sessiones","type"=>"number"])
				@include("components.select",["title"=>"Logo o Imagen Representativa :",
				"id"=>"logo","name"=>"logo","option"=>["Si", "No"]])
		   </div>
		   <div class="form-group row">
				<h3>Animaciones y Diseño grafico</h3>
				@include("components.checkbox",["title"=>"Barra Superior",
					"id"=>"ani_barra_sup","name"=>"ani_barra_sup"])
				@include("components.checkbox",["title"=>"Logo del Sitio",
				"id"=>"ani_logo","name"=>"ani_logo"])
				@include("components.checkbox",["title"=>"Banner Publicitario",
				"id"=>"ani_banner","name"=>"ani_banner"])
		   </div>
		   <div class="form-group  row">
				<h3>Elementos Dinamicos</h3>
				@include("components.checkbox",["title"=>"Carrito de Compras",
					"id"=>"carrito_compras","name"=>"carrito_compras"])
				@include("components.checkbox",["title"=>"Foro ",
					"id"=>"foro","name"=>"foro"])
				@include("components.checkbox",["title"=>"Sala de Chat",
					"id"=>"chat","name"=>"chat"])
				@include("components.checkbox",["title"=>"Libro de Visitas",
					"id"=>"libro_visitas","name"=>"libro_visitas"])
				@include("components.checkbox",["title"=>"Mapa del Sitio",
					"id"=>"mapa","name"=>"mapa"])
				@include("components.checkbox",["title"=>"Wiki",
					"id"=>"Wiki","name"=>"Wiki"])
				@include("components.checkbox",["title"=>"Sala de Chat",
				"id"=>"chat","name"=>"chat"])
				@include("components.checkbox",["title"=>"Sala de Chat",
				"id"=>"chat","name"=>"chat"])
			</div>
			<div class="form-group  row">
				<h3>E-Comerce</h3>
				@include("components.checkbox",["title"=>"Formulario de pedido",
					"id"=>"form_pedidos","name"=>"form_pedidos"])
				@include("components.checkbox",["title"=>"Panel de Control",
					"id"=>"panel_control","name"=>"panel_control"])
				@include("components.checkbox",["title"=>"Registracion Automatica",
					"id"=>"registracion","name"=>"registracion"])
			</div>
			<div class="form-group  row">
				<h3>Otros Servicios y Herramientas</h3>
				@include("components.checkbox",["title"=>"Buscador Interno",
					"id"=>"buscador","name"=>"buscador"])
				@include("components.checkbox",["title"=>"Estadisticas",
					"id"=>"estadisticas","name"=>"estadisticas"])
				@include("components.checkbox",["title"=>"Arquitectura de Informacion",
					"id"=>"arquitextura","name"=>"arquitextura"])
			</div>
		@endsection
		@include("components.form",["titleForm"=>"presupuesto web"])  
</div>
@endsection