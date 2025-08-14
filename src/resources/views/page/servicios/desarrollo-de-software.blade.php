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
<h1>Desarrollo de Software</h1>

<div class="row">	
	<div class="col-lg-9 col-md-9 col-sm-12">
		<p>En el momento que las pequeñas y medianas empresas crecen, sus necesidades van siendo cada mayores, como por ejemplo: Sus procesos más
	 	específicos, la seguridad y el control de información critica es un tema cada vez de mayor interés, entonces es aquí donde, el software
	  	genérico comienza a tener vacíos que no contemplan o satisfacen todas las necesidades de la misma.
		</p>
		<p>
			Es en ese momento cuando se hace necesario la implementación del software a media.
		</p>
		<p>
			El secreto del desarrollo de software a medida está en el análisis de su negocio, es lo que va a definir la efectividad de su programa o
	 		sistema. Un correcto re-elevamiento permite la creación del software que su actividad necesita.
		</p>
		<p>
		Nuestra experiencia en la programación a medida, nos dio conocimiento variado en lenguajes y entornos portales que facilitan la migración 
		en caso de ser necesario y además de un sistema ágil y acorde, elegimos la mejor opción para su proyecto.
		</p>
		<p>
			El objetivo primordial es lograr un software, que además de suplir las necesidades operativas, sea de fácil utilización, intuitivo y ágil.
		</p>
	</div>	
	<div class="col-lg-3 col-md-3 col-sm-12">
		<img src="media/img/servicios/trabajo.png" class="img-fluid"	/>
	</div>
</div>

<div class="row">	
	<div class="col-lg-8 col-md-8 col-sm-12">	
		<h2>Servicios adjuntos </h2>
		<ul class="list">
			<li>Análisis y Diseño de datos</li>
			<li>Diseño de base de datos</li>
			<li>Codificación</li>	
			<li>Testing</li>
			<li>Implementación</li>	
			<li>Mantenimiento</li>
		</ul>
	
		<h2>Tipos de software</h2>
		<ul class="list">
			<li>Sistemas</li>
			<li>Tiempo real</li>
			<li>Gestión</li>
			<li>Ingeniería y científico</li>
			<li>Empotrado</li>
			<li>Basado en la web</li>
			<li>Inteligencia artificial</li>
		</ul>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12">		
			<img src="media/img/servicios/asesoramiento.png" class="img-fluid"	/>
	</div>
</div>


</div>
	<div class="text-center">
   		<a href="#cotizacion" class="btn btn-success" data-bs-toggle="collapse" >
   			<i class="fas fa-file-contract"></i> Solicitar cotizacion
   		</a>
    </div>
       <div id="cotizacion" class="collapse" >
			@include('page.contacto.template.cotizacion')		
       </div> 
	   @endsection	
