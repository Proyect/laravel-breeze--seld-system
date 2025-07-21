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
	<h2>Sistema de Stock y Ventas</h2>
	
	<p>Si tienes un negocio y no estás aprovechando las ventajas que te ofrece un software empresarial, entonces este es el momento para
		 que lo consideres y te animes a implementarlo. </p>
	<p>Disponemos de un software de Fácil uso, simple, completo y a bajo costo Que le ayudará en la administración y el control de sus comercios.
		 El sistema simplifica las tareas de su Negocio, transformando los datos en información de valor para la toma de decisiones que potenciarán
		  sus ventas. </p>

	@include('components.carousel',["list"=>["media/img/productos/sistemas/stock/arqueo-de-caja.png",
									"media/img/productos/sistemas/stock/busqueda-avanzada-recibos.png",
									"media/img/productos/sistemas/stock/comprobante-de-compra.png",
									"media/img/productos/sistemas/stock/detalle-compra-modal.png"
	]])	  
	
					
	<h3>Características principales</h3>
	
	<p>Controla tu comercio desde cualquie lugar que estés, vas a poder monitorear todos los movimientos de tus comercios de forma rápida y fácil.
		 También podrás acceder al sistema desde cualquier Computadora, Tablet, Notebook o Celular.</p>

	<p>Detalles:</p>
	
	<ul>
		<li>Controlar todos los movimientos de su Negocios en un mismo Sistema. </li>
		<li>Controlar el stock de una forma más sencilla. </li>
		<li>Controlar las Ventas en un mismo Sistema.</li>
		<li>Hacer filtros de las ventas realizadas por: rangos de fechas, formas de pago, tipo de venta </li>
		<li>Etiquetado con código de barra / código de producto</li>
		<li>Visualizar estadísticas de las ventas y compras para la toma de decisiones. </li>
		<li>Acceder desde cualquier dispositivo. </li>
		<li>Esquema de permisos: Permisos y restricciones para los empleados de tu comercio.</li>
	</ul>			
		
	@include('page.productos.sist-planes',["basic_cost" =>"5 USD",  "advance_cost"=>"8 USD"])
	@include('page.productos.sist-beneficios')	
	@include('page.contacto.contrata-servicio',["sistema"=>"stock"])
		
	@endsection
		