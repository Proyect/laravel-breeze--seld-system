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

<div class="container text-justify">
<h1>Preguntas Frecuentes</h1>
            <div class="row">
			<div class="col">	
            <h3>¿Qué es Infrasoft - Servicios Informaticos?</h3>
            
            <p>Somos un grupo de jóvenes profesionales de diferentes ramas, para los cuales brindamos una variedad de servicios 
            	de gran calidad y adaptado a los requerimientos. </p>   
            	     
           <p>Para mas detalles de quienes somos puede verlo <a href="institucional.institucional">
           		<b>aqui.</b></a>.
           	</p>   
			</div>
			<div class = "col">
           <h3>¿Cuales son los servicios que se brindan?</h3>  
                
            <p>Los servicios que se brindan en la actualidad son los siguientes y puede ver en detalle en qué consiste cada uno
            	 de ellos:
            </p>
			</div>
			</div>
			<a class="btn btn-primary" data-bs-toggle="collapse" href="#sistemas" role="button" aria-expanded="false" 
					aria-controls="sistemas">
				Desarrollo de sistemas
  			</a>
			<a href="#web" class="btn btn-primary" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="web">
        		Desarrollo Web
        	</a>
			<a href="#mantenimiento-informatico" class="btn btn-primary" data-bs-toggle="collapse" role="button" 
					aria-expanded="false" aria-controls="mantenimiento-informatico">
       			Mantenimiento Informatico
       		</a>
		   	<a href="#camaras-de-seguridad" class="btn btn-primary" data-bs-toggle="collapse"  role="button" 
					aria-expanded="false" aria-controls="camaras-de-seguridad">
				Camaras de Seguridad
			</a>
			
		<div id="web" class="collapse">
			 @include("page.institucional.template.como-trabajamos") 
			
		</div>   
		
		<div id="sistemas" class="collapse">	
			@include('page.institucional.faq-desarrollo-de-sistemas') 
		</div>
       <div id="camaras-de-seguridad" class="collapse" >
			@include('page.institucional.faq-camaras-de-seguridad')  
	   </div>
       <div id="mantenimiento-informatico" class="collapse">
			@include('page.institucional.faq-mantenimiento-informatico') 
			hola3
       </div>
       <div class = "row">
		<div class = "col">
       <h3>¿ El Asesoramiento es gratuito ?</h3>
       
       <p>Si, Asesoramiento gratuito, posteriormente se analizan y diseñan posibles soluciones requeridas se genera un 
       		presupuestos, detallando cada servicio a brindar, tiempos de desarrollo, implementación, formas de pago, etc.
       </p>
		</div>
		<div class = "col">
       <h3>¿Los servicios estan garantizados?</h3>
       
       <p>	Todos los servicios tienen garantía de satisfacción.  Pactando de ante mano, tiempos de entrega, metodología de 
       		trabajo y requerimientos.
       </p>
		</div>
	   </div>
       <hr />
</div>                
@endsection